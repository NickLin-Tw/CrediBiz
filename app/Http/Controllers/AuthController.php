<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\EmployeeLoginLog;
use App\Models\ActivityLog;
use App\Services\TWDIWVerifierService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * 使用員工 VC 登入
     */
    public function login(Request $request, TWDIWVerifierService $verifierService)
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

        try {
            // 先嘗試從資料庫取得已儲存的 VP 結果
            $vpResult = $verifierService->getStoredVPResult($vpTransactionId);

            // 如果資料庫沒有，從 TW-DIW 取得（會自動儲存）
            if (!$vpResult) {
                $vpResult = $verifierService->getVPResult($vpTransactionId);
            }

            // 驗證 VP 狀態（verifyResult 為 boolean）
            if (!isset($vpResult['verifyResult']) || $vpResult['verifyResult'] !== true) {
                return response()->json([
                    'success' => false,
                    'message' => 'VP 驗證失敗',
                    'error' => $vpResult['resultDescription'] ?? '未知錯誤',
                ], 400);
            }

            if (!isset($vpResult['data']) || count($vpResult['data']) === 0) {
                return response()->json([
                    'success' => false,
                    'message' => '需要提供員工憑證',
                ], 400);
            }

            // 解析員工憑證
            $credentials = $vpResult['data'];
            $employeeId = null;

            foreach ($credentials as $vc) {
                if (!isset($vc['claims'])) {
                    continue;
                }

                $claims = $vc['claims'];
                foreach ($claims as $claim) {
                    if ($claim['ename'] === 'employee_id') {
                        // VP 驗證結果的 claims 使用 'value' 欄位
                        $employeeId = $claim['value'];
                        break 2;
                    }
                }
            }

            if (!$employeeId) {
                return response()->json([
                    'success' => false,
                    'message' => '無法從憑證中取得員工編號',
                ], 400);
            }

            // 查詢員工資料
            $employee = Employee::where('employee_id', $employeeId)->first();

            if (!$employee) {
                return response()->json([
                    'success' => false,
                    'message' => '找不到員工資料',
                ], 404);
            }

            // 檢查員工是否已領取憑證
            if (!$employee->employee_vc_cid) {
                return response()->json([
                    'success' => false,
                    'message' => '此員工尚未領取員工憑證',
                ], 403);
            }

            // 記錄登入 log
            EmployeeLoginLog::create([
                'employee_id' => $employee->employee_id,
                'vp_transaction_id' => $vpTransactionId,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // 記錄 VP 驗證活動日誌
            ActivityLog::logVPVerification(
                transactionId: $vpTransactionId,
                reason: '員工使用 VC 登入系統',
                success: true,
                employeeId: $employee->employee_id,
                metadata: [
                    'login' => true,
                    'ip_address' => $request->ip(),
                ]
            );

            // 刪除舊的 token（確保同一時間只有一個有效 token）
            $employee->tokens()->delete();

            // 更新最後登入時間
            $employee->update([
                'last_login_at' => now(),
            ]);

            // 發行新的 API token
            $token = $employee->createToken('employee-auth')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => '登入成功',
                'token' => $token,
                'employee' => [
                    'employee_id' => $employee->employee_id,
                    'name' => $employee->name,
                    'position' => $employee->position,
                    'department' => $employee->department,
                    'company_name' => $employee->company_name,
                ],
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '登入過程發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 登出
     */
    public function logout(Request $request)
    {
        // 撤銷當前使用的 token
        $request->user()?->currentAccessToken()?->delete();

        return response()->json([
            'success' => true,
            'message' => '登出成功',
        ]);
    }
}
