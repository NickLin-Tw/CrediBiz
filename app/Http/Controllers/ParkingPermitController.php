<?php

namespace App\Http\Controllers;

use App\Models\ParkingPermit;
use App\Models\ParkingPermitVehicle;
use App\Models\Employee;
use App\Models\VPVerificationResult;
use App\Models\IssuedVC;
use App\Models\ActivityLog;
use App\Services\TWDIWVerifierService;
use App\Services\TWDIWIssuerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ParkingPermitController extends Controller
{
    /**
     * 產生員工證驗證 QR Code（用於停車證申請）
     */
    public function generateVerificationQR(Request $request, TWDIWVerifierService $verifierService)
    {
        $validator = Validator::make($request->all(), [
            'transactionId' => 'required|string|uuid',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '無效的交易 ID',
                'errors' => $validator->errors(),
            ], 422);
        }

        $employee = $request->user();
        $transactionId = $request->input('transactionId');

        try {
            // 檢查員工是否已有停車證
            $existingPermit = ParkingPermit::where('employee_id', $employee->employee_id)->first();
            if ($existingPermit) {
                return response()->json([
                    'success' => false,
                    'message' => '您已經申請過停車證，每位員工只能申請一張停車證',
                ], 400);
            }

            // 產生 VP 驗證 QR Code（使用前端傳來的 transactionId）
            $result = $verifierService->generateVPQRCode(
                ref: '00000000_vp_employee_login',
                transactionId: $transactionId
            );

            return response()->json([
                'success' => true,
                'transactionId' => $result['transactionId'],
                'qrCode' => $result['qrCode'],
                'authUri' => $result['authUri'] ?? null,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '產生驗證 QR Code 失敗',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 驗證員工證 VP
     */
    public function verifyEmployeeCredential(Request $request, TWDIWVerifierService $verifierService)
    {
        $validator = Validator::make($request->all(), [
            'vp_transaction_id' => 'required|string|uuid',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '無效的交易 ID',
                'errors' => $validator->errors(),
            ], 422);
        }

        $vpTransactionId = $request->input('vp_transaction_id');
        $employee = $request->user();

        try {
            // 從資料庫或 TW-DIW 取得 VP 結果
            $vpResult = $verifierService->getStoredVPResult($vpTransactionId);
            if (!$vpResult) {
                $vpResult = $verifierService->getVPResult($vpTransactionId);
            }

            // 檢查 VP 是否驗證成功
            if (!isset($vpResult['verifyResult']) || $vpResult['verifyResult'] !== true) {
                return response()->json([
                    'success' => false,
                    'message' => 'VP 驗證失敗',
                    'error' => $vpResult['resultDescription'] ?? '未知錯誤',
                ], 400);
            }

            // 解析 VP 資料，檢查是否有員工證
            $credentials = $vpResult['data'] ?? [];
            $employeeCredential = null;

            foreach ($credentials as $credential) {
                if (($credential['credentialType'] ?? '') === '00000000_vc_employee_credential') {
                    $employeeCredential = $credential;
                    break;
                }
            }

            if (!$employeeCredential) {
                return response()->json([
                    'success' => false,
                    'message' => '缺少員工證憑證',
                ], 400);
            }

            // 解析員工證資料
            $employeeData = $this->parseClaimsToArray($employeeCredential['claims'] ?? []);
            $employeeName = $employeeData['name'] ?? '';
            $employeeId = $employeeData['employee_id'] ?? '';

            // 檢查員工姓名和編號是否與登入者一致
            if ($employeeName !== $employee->name || $employeeId !== $employee->employee_id) {
                return response()->json([
                    'success' => false,
                    'message' => '員工證資料與登入者不符',
                ], 400);
            }

            // 檢查是否已使用此 VP 申請過
            $existingPermit = ParkingPermit::where('vp_transaction_id', $vpTransactionId)->first();
            if ($existingPermit) {
                return response()->json([
                    'success' => false,
                    'message' => '此驗證已被使用過',
                ], 400);
            }

            // 檢查員工是否已有停車證
            $existingPermit = ParkingPermit::where('employee_id', $employee->employee_id)->first();
            if ($existingPermit) {
                return response()->json([
                    'success' => false,
                    'message' => '您已經申請過停車證，每位員工只能申請一張停車證',
                ], 400);
            }

            // 驗證成功，返回員工資料
            return response()->json([
                'success' => true,
                'message' => 'VP 驗證成功',
                'data' => [
                    'employee_name' => $employeeName,
                    'employee_id' => $employeeId,
                    'vp_transaction_id' => $vpTransactionId,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '驗證過程發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 申請停車證（發行 VC）
     */
    public function apply(Request $request, TWDIWIssuerService $issuerService)
    {
        $validator = Validator::make($request->all(), [
            'vp_transaction_id' => 'required|string|uuid',
            'vehicles' => 'required|array|min:1',
            'vehicles.*.vehicle_plate_number' => 'required|string',
            'vehicles.*.vehicle_type' => 'required|string',
            'vehicles.*.brand_model' => 'required|string',
            'vehicles.*.color' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '表單驗證失敗',
                'errors' => $validator->errors(),
            ], 422);
        }

        $employee = $request->user();
        $vpTransactionId = $request->input('vp_transaction_id');
        $vehicles = $request->input('vehicles');

        try {
            DB::beginTransaction();

            // 再次檢查員工是否已有停車證
            $existingPermit = ParkingPermit::where('employee_id', $employee->employee_id)->first();
            if ($existingPermit) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => '您已經申請過停車證，每位員工只能申請一張停車證',
                ], 400);
            }

            // 產生停車證編號
            $permitId = ParkingPermit::generatePermitId();

            // 發行停車證 VC
            $vcResult = $issuerService->issueVC(
                vcUid: '00000000_vc_parking_permit',
                fields: [
                    'name' => $employee->name,
                    'permid_id' => $permitId,
                    'parking_type' => '員工停車',
                ]
            );

            $transactionId = $vcResult['transactionId'];

            // 建立停車證記錄
            $parkingPermit = ParkingPermit::create([
                'employee_id' => $employee->employee_id,
                'permit_id' => $permitId,
                'vp_transaction_id' => $vpTransactionId,
                'vc_transaction_id' => $transactionId,
                'name' => $employee->name,
                'parking_type' => '員工停車',
            ]);

            // 建立車輛記錄
            foreach ($vehicles as $vehicle) {
                ParkingPermitVehicle::create([
                    'parking_permit_id' => $parkingPermit->id,
                    'vehicle_plate_number' => $vehicle['vehicle_plate_number'],
                    'vehicle_type' => $vehicle['vehicle_type'],
                    'brand_model' => $vehicle['brand_model'],
                    'color' => $vehicle['color'],
                ]);
            }

            // 標記 VP 為已使用
            VPVerificationResult::where('transaction_id', $vpTransactionId)
                ->update(['is_used' => true]);

            DB::commit();

            // 返回 QR Code 資料
            return response()->json([
                'success' => true,
                'message' => '停車證申請成功',
                'data' => [
                    'permit_id' => $permitId,
                    'transaction_id' => $transactionId,
                    'qr_code' => $vcResult['qrCode'],
                    'deep_link' => $vcResult['deepLink'] ?? null,
                ],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => '申請停車證時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 確認停車證領取（更新 VC CID）
     */
    public function confirmIssuance(Request $request, TWDIWIssuerService $issuerService)
    {
        $validator = Validator::make($request->all(), [
            'vc_transaction_id' => 'required|string',
            'vc_cid' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '無效的憑證資料',
                'errors' => $validator->errors(),
            ], 422);
        }

        $employee = $request->user();
        $transactionId = $request->input('vc_transaction_id');
        $vcCid = $request->input('vc_cid');

        try {
            // 查找停車證
            $parkingPermit = ParkingPermit::where('employee_id', $employee->employee_id)
                ->where('vc_transaction_id', $transactionId)
                ->first();

            if (!$parkingPermit) {
                return response()->json([
                    'success' => false,
                    'message' => '找不到停車證申請記錄',
                ], 404);
            }

            // 從 TW-DIW 查詢 VC 狀態以取得 holder DID
            $vcStatus = $issuerService->getVCStatus($transactionId);
            $holderDid = $vcStatus['holderDid'] ?? null;

            // 檢查 holder DID 是否與員工記錄中的一致（確保是同一裝置）
            if ($employee->holder_did && $employee->holder_did !== $holderDid) {
                // Holder DID 不符，立即 revoke 停車證 VC
                try {
                    $issuerService->changeVCStatus($vcCid, 'revocation');

                    // 刪除停車證記錄
                    $parkingPermit->delete();

                    // 記錄活動日誌
                    ActivityLog::log([
                        'employee_id' => $employee->employee_id,
                        'actor_id' => $employee->employee_id,
                        'actor_type' => 'employee',
                        'action' => 'revoke_vc',
                        'action_display' => '撤銷停車證 VC',
                        'description' => '停車證申請失敗：Holder DID 不符（非同一裝置），已自動撤銷',
                        'target_type' => 'parking_permit',
                        'target_id' => $vcCid,
                        'status' => 'success',
                    ]);
                } catch (\Exception $revokeError) {
                    // 記錄 revoke 失敗的錯誤，但仍繼續返回主要錯誤訊息
                    \Illuminate\Support\Facades\Log::warning('停車證撤銷失敗', [
                        'vc_cid' => $vcCid,
                        'employee_id' => $employee->employee_id,
                        'error' => $revokeError->getMessage(),
                    ]);
                }

                return response()->json([
                    'success' => false,
                    'message' => '申請失敗：您使用的數位憑證皮夾裝置與領取員工證時不同。停車證已被撤銷，請使用原本的裝置重新操作。',
                    'holder_did_mismatch' => true,
                ], 400);
            }

            // 更新停車證資料
            $parkingPermit->update([
                'vc_cid' => $vcCid,
                'issued_at' => now(),
                'expiry_date' => now()->addYear(),
            ]);

            // 記錄已發行的 VC
            IssuedVC::create([
                'employee_id' => $employee->employee_id,
                'vc_cid' => $vcCid,
                'vc_uid' => '00000000_vc_parking_permit',
                'transaction_id' => $transactionId,
            ]);

            // 記錄活動日誌
            ActivityLog::logVCIssue(
                employeeId: $employee->employee_id,
                vcCid: $vcCid,
                vcUid: '00000000_vc_parking_permit',
                reason: '申請停車證',
                actorId: $employee->employee_id,
                actorType: 'employee'
            );

            return response()->json([
                'success' => true,
                'message' => '停車證領取成功',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '確認領取時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 查詢員工的停車證
     */
    public function show(Request $request)
    {
        $employee = $request->user();

        $permit = ParkingPermit::with('vehicles')
            ->where('employee_id', $employee->employee_id)
            ->first();

        if (!$permit) {
            return response()->json([
                'success' => true,
                'has_permit' => false,
                'data' => null,
            ]);
        }

        return response()->json([
            'success' => true,
            'has_permit' => true,
            'data' => [
                'permit_id' => $permit->permit_id,
                'name' => $permit->name,
                'parking_type' => $permit->parking_type,
                'issued_at' => $permit->issued_at?->format('Y-m-d H:i:s'),
                'expiry_date' => $permit->expiry_date?->format('Y-m-d'),
                'vc_cid' => $permit->vc_cid,
                'vehicles' => $permit->vehicles->map(function ($vehicle) {
                    return [
                        'id' => $vehicle->id,
                        'vehicle_plate_number' => $vehicle->vehicle_plate_number,
                        'vehicle_type' => $vehicle->vehicle_type,
                        'brand_model' => $vehicle->brand_model,
                        'color' => $vehicle->color,
                    ];
                }),
            ],
        ]);
    }

    /**
     * 更新車輛資訊（不影響 VC）
     */
    public function updateVehicles(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicles' => 'required|array|min:1',
            'vehicles.*.vehicle_plate_number' => 'required|string',
            'vehicles.*.vehicle_type' => 'required|string',
            'vehicles.*.brand_model' => 'required|string',
            'vehicles.*.color' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '表單驗證失敗',
                'errors' => $validator->errors(),
            ], 422);
        }

        $employee = $request->user();
        $vehicles = $request->input('vehicles');

        try {
            DB::beginTransaction();

            // 查詢停車證
            $permit = ParkingPermit::where('employee_id', $employee->employee_id)->first();

            if (!$permit) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => '您目前沒有停車證',
                ], 400);
            }

            // 刪除舊的車輛資料
            ParkingPermitVehicle::where('parking_permit_id', $permit->id)->delete();

            // 新增新的車輛資料
            foreach ($vehicles as $vehicleData) {
                ParkingPermitVehicle::create([
                    'parking_permit_id' => $permit->id,
                    'vehicle_plate_number' => $vehicleData['vehicle_plate_number'],
                    'vehicle_type' => $vehicleData['vehicle_type'],
                    'brand_model' => $vehicleData['brand_model'],
                    'color' => $vehicleData['color'],
                ]);
            }

            // 記錄活動日誌
            ActivityLog::log([
                'activity_type' => 'parking_permit_vehicle_update',
                'description' => '員工更新停車證車輛資訊',
                'employee_id' => $employee->employee_id,
                'metadata' => [
                    'permit_id' => $permit->permit_id,
                    'vehicle_count' => count($vehicles),
                ],
            ]);

            DB::commit();

            // 重新載入車輛資料
            $permit->load('vehicles');

            return response()->json([
                'success' => true,
                'message' => '車輛資訊更新成功',
                'data' => [
                    'vehicles' => $permit->vehicles->map(function ($vehicle) {
                        return [
                            'id' => $vehicle->id,
                            'vehicle_plate_number' => $vehicle->vehicle_plate_number,
                            'vehicle_type' => $vehicle->vehicle_type,
                            'brand_model' => $vehicle->brand_model,
                            'color' => $vehicle->color,
                        ];
                    }),
                ],
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => '更新車輛資訊失敗',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 換發停車證（撤銷舊的，允許重新申請）
     */
    public function reissue(Request $request, TWDIWIssuerService $issuerService)
    {
        $employee = $request->user();

        try {
            DB::beginTransaction();

            // 查詢現有停車證
            $existingPermit = ParkingPermit::where('employee_id', $employee->employee_id)->first();

            if (!$existingPermit) {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => '您目前沒有停車證，無法執行換發',
                ], 400);
            }

            // 撤銷舊的 VC
            if ($existingPermit->vc_cid) {
                try {
                    $issuerService->changeVCStatus($existingPermit->vc_cid, 'revocation');

                    // 記錄撤銷活動日誌
                    ActivityLog::logVCRevoke(
                        employeeId: $employee->employee_id,
                        vcCid: $existingPermit->vc_cid,
                        reason: '員工申請換發停車證',
                        actorId: $employee->employee_id,
                        actorType: 'employee'
                    );
                } catch (\Exception $revokeError) {
                    // 如果撤銷失敗，記錄錯誤但繼續流程（允許手動處理）
                    \Log::error('停車證撤銷失敗', [
                        'vc_cid' => $existingPermit->vc_cid,
                        'error' => $revokeError->getMessage(),
                    ]);
                }
            }

            // 刪除舊的停車證及車輛資料
            ParkingPermitVehicle::where('parking_permit_id', $existingPermit->id)->delete();
            $existingPermit->delete();

            // 記錄活動日誌
            ActivityLog::log([
                'activity_type' => 'parking_permit_reissue',
                'description' => '員工申請換發停車證',
                'employee_id' => $employee->employee_id,
                'metadata' => [
                    'old_permit_id' => $existingPermit->permit_id,
                ],
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => '舊停車證已撤銷，請重新申請新的停車證',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => '換發停車證失敗',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 將 claims 陣列轉換為 key-value 陣列
     */
    private function parseClaimsToArray(array $claims): array
    {
        $result = [];
        foreach ($claims as $claim) {
            $ename = $claim['ename'] ?? '';
            $value = $claim['value'] ?? '';
            if ($ename) {
                $result[$ename] = $value;
            }
        }
        return $result;
    }
}
