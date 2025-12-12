<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TWDIWVerifierService;
use App\Models\VPMachine;
use App\Models\VPVerificationLog;
use App\Models\ParkingPermit;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class VPMachineController extends Controller
{
    /**
     * 取得 VP 驗證配置（動態讀取機器設定）
     */
    public function getConfig(string $machineId, TWDIWVerifierService $verifierService)
    {
        try {
            // 取得機器配置
            $machineConfig = VPMachine::getConfigByMachineId($machineId);

            if (!$machineConfig) {
                return response()->json([
                    'success' => false,
                    'message' => '機器不存在或未啟用',
                ], 404);
            }

            // 產生新的 transaction ID
            $transactionId = Str::uuid()->toString();

            // 使用機器配置的 VP ref
            $vpRef = $machineConfig['vp_ref'];
            $vpName = $machineConfig['vp_name'];

            // 產生 VP 驗證 QR Code
            $result = $verifierService->generateVPQRCode(
                ref: $vpRef,
                transactionId: $transactionId
            );

            // 記錄：取得配置
            VPVerificationLog::logConfigRequest($machineId, $transactionId, $vpRef, $vpName);

            return response()->json([
                'success' => true,
                'data' => [
                    'transaction_id' => $transactionId,
                    'vp_ref' => $vpRef,
                    'vp_name' => $vpName,
                    'machine_name' => $machineConfig['machine_name'],
                    'location' => $machineConfig['location'],
                    // qr_code 移除（Arduino 用不到，且太大會導致 JSON 解析失敗）
                    'auth_uri' => $result['authUri'] ?? $result['deepLink'] ?? null,
                    'timeout' => 300,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '產生驗證配置失敗',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 查詢驗證結果（停車證驗證邏輯）
     */
    public function verifyResult(Request $request, TWDIWVerifierService $verifierService)
    {
        $validator = Validator::make($request->all(), [
            'machine_id' => 'required|string',
            'transaction_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '參數驗證失敗',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $machineId = $request->input('machine_id');
            $transactionId = $request->input('transaction_id');

            // 取得機器配置
            $machineConfig = VPMachine::getConfigByMachineId($machineId);

            if (!$machineConfig) {
                return response()->json([
                    'success' => false,
                    'message' => '機器不存在或未啟用',
                ], 404);
            }

            $vpRef = $machineConfig['vp_ref'];
            $vpName = $machineConfig['vp_name'];

            // 查詢 VP 驗證結果
            $result = $verifierService->getStoredVPResult($transactionId);

            if (!$result) {
                return response()->json([
                    'success' => true,
                    'data' => [
                        'verify_result' => null,
                        'result_description' => '尚未完成驗證',
                    ],
                ]);
            }

            // 解析停車證資料
            $credentials = $result['data'] ?? [];
            $parkingData = $this->extractParkingPermitData($credentials);

            if (empty($parkingData)) {
                // 驗證失敗：無法解析停車證資料
                VPVerificationLog::logVerifyFailed(
                    $machineId,
                    $transactionId,
                    $vpRef,
                    $vpName,
                    '無法解析停車證資料'
                );

                return response()->json([
                    'success' => true,
                    'data' => [
                        'verify_result' => false,
                        'result_description' => '無效的停車證',
                    ],
                ]);
            }

            // 驗證停車證
            $validationResult = $this->validateParkingPermit($parkingData);

            if (!$validationResult['is_valid']) {
                // 驗證失敗
                VPVerificationLog::logVerifyFailed(
                    $machineId,
                    $transactionId,
                    $vpRef,
                    $vpName,
                    $validationResult['reason']
                );

                return response()->json([
                    'success' => true,
                    'data' => [
                        'verify_result' => false,
                        'result_description' => $validationResult['reason'],
                        'error_type' => $validationResult['error_type'],
                    ],
                ]);
            }

            // 驗證成功
            VPVerificationLog::logVerifySuccess(
                $machineId,
                $transactionId,
                $vpRef,
                $vpName,
                $parkingData
            );

            return response()->json([
                'success' => true,
                'data' => [
                    'verify_result' => true,
                    'result_description' => '驗證成功',
                    'name' => $parkingData['name'],
                    'permit_id' => $parkingData['permit_id'],
                    'parking_type' => $parkingData['parking_type'],
                    'expiry_date' => $parkingData['expiry_date'] ?? null,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '查詢驗證結果失敗',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 從 VP 資料中提取停車證資訊
     */
    private function extractParkingPermitData(array $credentials): array
    {
        $parkingData = [];

        foreach ($credentials as $credential) {
            if (isset($credential['credentialType']) &&
                $credential['credentialType'] === '00000000_vc_parking_permit') {

                $claims = $credential['claims'] ?? [];

                foreach ($claims as $claim) {
                    $ename = $claim['ename'] ?? '';
                    $value = $claim['value'] ?? '';

                    switch ($ename) {
                        case 'permit_id':
                            $parkingData['permit_id'] = $value;
                            break;
                        case 'name':
                            $parkingData['name'] = $value;
                            break;
                        case 'parking_type':
                            $parkingData['parking_type'] = $value;
                            break;
                        case 'expiry_date':
                            $parkingData['expiry_date'] = $value;
                            break;
                    }
                }
                break;
            }
        }

        return $parkingData;
    }

    /**
     * 驗證停車證（檢查過期、狀態）
     */
    private function validateParkingPermit(array $parkingData): array
    {
        $permitId = $parkingData['permit_id'] ?? null;

        if (!$permitId) {
            return [
                'is_valid' => false,
                'reason' => '停車證編號不存在',
                'error_type' => 'invalid_permit',
            ];
        }

        // 查詢資料庫中的停車證
        $permit = ParkingPermit::where('permit_id', $permitId)->first();

        if (!$permit) {
            return [
                'is_valid' => false,
                'reason' => '停車證不存在於系統中',
                'error_type' => 'not_found',
            ];
        }

        // 檢查是否過期（硬性拒絕）
        if ($permit->expiry_date && Carbon::parse($permit->expiry_date)->lt(now())) {
            return [
                'is_valid' => false,
                'reason' => '停車證已過期',
                'error_type' => 'expired',
            ];
        }

        // 驗證成功
        return [
            'is_valid' => true,
            'reason' => '驗證成功',
        ];
    }
}
