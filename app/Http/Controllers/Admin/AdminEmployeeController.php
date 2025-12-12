<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\IssuedVC;
use App\Models\VCStatusChangeLog;
use App\Models\ActivityLog;
use App\Services\TWDIWIssuerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AdminEmployeeController extends Controller
{
    /**
     * 取得員工列表（含搜尋、篩選）
     */
    public function index(Request $request)
    {
        $query = Employee::query();

        // 搜尋
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('employee_id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%")
                    ->orWhere('position', 'like', "%{$search}%");
            });
        }

        // 篩選：在職狀態
        if ($request->has('is_active')) {
            $query->where('is_active', $request->boolean('is_active'));
        }

        // 篩選：是否有憑證
        if ($request->has('has_credential')) {
            if ($request->boolean('has_credential')) {
                $query->whereNotNull('employee_vc_cid');
            } else {
                $query->whereNull('employee_vc_cid');
            }
        }

        // 排序
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // 分頁
        $perPage = $request->input('per_page', 15);
        $employees = $query->with(['issuedVCs' => function ($query) {
            $query->where('is_revoked', false);
        }])->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $employees->items(),
            'total' => $employees->total(),
            'current_page' => $employees->currentPage(),
            'last_page' => $employees->lastPage(),
            'per_page' => $employees->perPage(),
        ]);
    }

    /**
     * 取得員工詳細資料
     */
    public function show(string $employeeId)
    {
        $employee = Employee::where('employee_id', $employeeId)
            ->with([
                'issuedVCs',
                'medicalLeaves' => function ($query) {
                    $query->orderBy('created_at', 'desc')->limit(10);
                },
                'activityLogs' => function ($query) {
                    $query->orderBy('created_at', 'desc')->limit(20);
                },
            ])
            ->first();

        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => '找不到員工資料',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'employee' => $employee,
        ]);
    }

    /**
     * Revoke 特定 VC
     */
    public function revokeVC(Request $request, TWDIWIssuerService $issuerService)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|string',
            'vc_cid' => 'required|string',
            'reason' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '驗證失敗',
                'errors' => $validator->errors(),
            ], 422);
        }

        $employee = Employee::where('employee_id', $request->input('employee_id'))->first();

        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => '找不到員工資料',
            ], 404);
        }

        $vcCid = $request->input('vc_cid');
        $reason = $request->input('reason');

        // 檢查該 VC 是否屬於該員工
        $issuedVC = IssuedVC::where('employee_id', $employee->employee_id)
            ->where('vc_cid', $vcCid)
            ->where('is_revoked', false)
            ->first();

        if (!$issuedVC) {
            return response()->json([
                'success' => false,
                'message' => '找不到該憑證或憑證已被撤銷',
            ], 404);
        }

        DB::beginTransaction();

        try {
            // 呼叫 TW-DIW API revoke VC
            $revokeResponse = $issuerService->changeVCStatus($vcCid, 'revocation');

            // 更新 issued_vcs 表
            $issuedVC->update([
                'is_revoked' => true,
                'revoked_at' => now(),
            ]);

            // 如果是員工憑證，更新 employees 表
            if ($employee->employee_vc_cid === $vcCid) {
                $employee->update([
                    'employee_vc_cid' => null,
                    'employee_vc_transaction_id' => null,
                ]);
            }

            // 記錄 VC 狀態變更 log
            VCStatusChangeLog::create([
                'employee_id' => $employee->employee_id,
                'action' => 'revocation',
                'reason' => $reason,
                'old_vc_cid' => $vcCid,
                'vc_uid' => $issuedVC->vc_uid,
                'response_data' => $revokeResponse,
            ]);

            // 記錄活動日誌
            ActivityLog::logVCRevoke(
                employeeId: $employee->employee_id,
                vcCid: $vcCid,
                reason: $reason,
                actorId: 'admin',
                actorType: 'admin'
            );

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => '憑證已成功撤銷',
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => '撤銷憑證時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 換發員工 VC（管理員操作）
     */
    public function reissueVC(Request $request, TWDIWIssuerService $issuerService)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|string',
            'reason' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '驗證失敗',
                'errors' => $validator->errors(),
            ], 422);
        }

        $employee = Employee::where('employee_id', $request->input('employee_id'))->first();

        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => '找不到員工資料',
            ], 404);
        }

        $reason = $request->input('reason');

        DB::beginTransaction();

        try {
            $oldCid = $employee->employee_vc_cid;

            // 準備 VC 欄位資料
            $fields = [
                'employee_id' => $employee->employee_id,
                'name' => $employee->name,
                'position' => $employee->position,
                'department' => $employee->department,
                'company_name' => $employee->company_name,
                'employment_start_date' => $employee->employment_start_date->format('Y-m-d'),
            ];

            // 發行新的 VC
            $result = $issuerService->issueVC('00000000_vc_employee_credential', $fields);

            // 如果有舊憑證，撤銷它
            if ($oldCid) {
                try {
                    $issuerService->changeVCStatus($oldCid, 'revocation');

                    // 更新舊憑證狀態
                    IssuedVC::where('vc_cid', $oldCid)->update([
                        'is_revoked' => true,
                        'revoked_at' => now(),
                    ]);

                    // 記錄撤銷活動
                    ActivityLog::logVCRevoke(
                        employeeId: $employee->employee_id,
                        vcCid: $oldCid,
                        reason: "管理員換發憑證：{$reason}",
                        actorId: 'admin',
                        actorType: 'admin'
                    );
                } catch (\Exception $e) {
                    // 如果撤銷失敗，記錄但不中斷流程
                    \Log::warning("換發憑證時撤銷舊憑證失敗: {$e->getMessage()}");
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => '憑證換發 QR Code 已產生，請員工掃描領取',
                'transactionId' => $result['transactionId'],
                'qrCode' => $result['qrCode'],
                'deepLink' => $result['deepLink'],
                'oldCid' => $oldCid,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => '換發憑證時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 員工離職處理（revoke 所有 VC）
     */
    public function resign(Request $request, TWDIWIssuerService $issuerService)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|string',
            'resignation_date' => 'required|date',
            'resignation_reason' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '驗證失敗',
                'errors' => $validator->errors(),
            ], 422);
        }

        $employee = Employee::where('employee_id', $request->input('employee_id'))->first();

        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => '找不到員工資料',
            ], 404);
        }

        if (!$employee->is_active) {
            return response()->json([
                'success' => false,
                'message' => '該員工已離職',
            ], 400);
        }

        DB::beginTransaction();

        try {
            // 取得該員工所有未撤銷的 VC
            $activeVCs = IssuedVC::where('employee_id', $employee->employee_id)
                ->where('is_revoked', false)
                ->get();

            $revokedCount = 0;
            $failedVCs = [];

            // 逐一撤銷所有 VC
            foreach ($activeVCs as $vc) {
                try {
                    $issuerService->changeVCStatus($vc->vc_cid, 'revocation');

                    $vc->update([
                        'is_revoked' => true,
                        'revoked_at' => now(),
                    ]);

                    // 記錄撤銷活動
                    ActivityLog::logVCRevoke(
                        employeeId: $employee->employee_id,
                        vcCid: $vc->vc_cid,
                        reason: "員工離職，自動撤銷所有憑證",
                        actorId: 'admin',
                        actorType: 'admin'
                    );

                    $revokedCount++;
                } catch (\Exception $e) {
                    $failedVCs[] = [
                        'vc_cid' => $vc->vc_cid,
                        'error' => $e->getMessage(),
                    ];
                }
            }

            // 更新員工狀態為離職
            $employee->update([
                'is_active' => false,
                'resignation_date' => $request->input('resignation_date'),
                'resignation_reason' => $request->input('resignation_reason'),
                'employee_vc_cid' => null,
                'employee_vc_transaction_id' => null,
            ]);

            // 記錄離職活動
            ActivityLog::log([
                'employee_id' => $employee->employee_id,
                'actor_id' => 'admin',
                'actor_type' => 'admin',
                'action' => 'employee_resign',
                'action_display' => '員工離職',
                'description' => $request->input('resignation_reason') ?? '員工離職',
                'target_type' => 'employee',
                'target_id' => $employee->employee_id,
                'status' => 'success',
                'metadata' => [
                    'revoked_vcs_count' => $revokedCount,
                    'failed_vcs' => $failedVCs,
                ],
            ]);

            DB::commit();

            $message = "員工離職處理完成。已撤銷 {$revokedCount} 個憑證。";
            if (count($failedVCs) > 0) {
                $message .= "有 " . count($failedVCs) . " 個憑證撤銷失敗。";
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'revoked_count' => $revokedCount,
                'failed_vcs' => $failedVCs,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => '處理員工離職時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 更新員工資料
     */
    public function update(Request $request, string $employeeId)
    {
        $employee = Employee::where('employee_id', $employeeId)->first();

        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => '找不到員工資料',
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:100',
            'position' => 'sometimes|string|max:100',
            'department' => 'sometimes|string|max:100',
            'employment_start_date' => 'sometimes|date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '驗證失敗',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $employee->update($request->only([
                'name',
                'position',
                'department',
                'employment_start_date',
            ]));

            return response()->json([
                'success' => true,
                'message' => '員工資料已更新',
                'employee' => $employee,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '更新員工資料時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
