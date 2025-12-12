<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\ActivityLog;
use App\Services\TWDIWVerifierService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ApplicationController extends Controller
{
    /**
     * 處理應徵申請（透過 VP 交易 ID + 手動填寫欄位）
     */
    public function store(Request $request, TWDIWVerifierService $verifierService)
    {
        // 1. 驗證輸入
        $validator = Validator::make($request->all(), [
            'vp_transaction_id' => 'required|string|uuid',
            'manual_fields' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '無效的請求資料',
                'errors' => $validator->errors(),
            ], 422);
        }

        $vpTransactionId = $request->input('vp_transaction_id');
        $manualFields = $request->input('manual_fields', []);

        // 檢查是否已經使用過此 VP
        if (Employee::where('vp_transaction_id', $vpTransactionId)->exists()) {
            return response()->json([
                'success' => false,
                'message' => '此憑證已被使用過',
            ], 409);
        }

        try {
            // 2. 從資料庫取得已保存的 VP 結果（前端輪詢時已保存，TW-DIW 已刪除資料）
            $vpResult = $verifierService->getStoredVPResult($vpTransactionId);

            if (!$vpResult) {
                return response()->json([
                    'success' => false,
                    'message' => '找不到驗證結果，請重新驗證',
                ], 400);
            }

            // 3. 驗證 VP 狀態
            if (!$vpResult['verifyResult']) {
                return response()->json([
                    'success' => false,
                    'message' => 'VP 驗證失敗',
                    'error' => $vpResult['resultDescription'] ?? '未知錯誤',
                ], 400);
            }

            if (!isset($vpResult['data']) || count($vpResult['data']) !== 3) {
                return response()->json([
                    'success' => false,
                    'message' => '需要提供完整的三張憑證',
                ], 400);
            }

            // 4. 解析 VP 中三張 VC 的資料
            $credentials = $vpResult['data'];
            $employeeData = [
                'vp_transaction_id' => $vpTransactionId,
                'company_name' => '臺灣航空',
                'department' => '客艙部',
                'position' => '空服員',
                'employment_start_date' => Carbon::today(),
            ];

            $names = [];

            foreach ($credentials as $vc) {
                if (!isset($vc['claims'])) {
                    continue;
                }

                $claims = $vc['claims'];

                // 收集姓名以檢查一致性
                foreach ($claims as $claim) {
                    if ($claim['ename'] === 'name') {
                        $names[] = $claim['value'];
                    }
                }

                // 根據 claims 判斷 VC 類型並提取資料
                $this->extractVCData($claims, $employeeData);
            }

            // 5. 檢查姓名一致性
            if (count($names) !== 3 || count(array_unique($names)) !== 1) {
                return response()->json([
                    'success' => false,
                    'message' => '不同憑證中的姓名不一致',
                ], 400);
            }

            // 6. 合併手動填寫的欄位（手動填寫的欄位優先於 VP 資料）
            foreach ($manualFields as $key => $value) {
                if ($value !== null && $value !== '') {
                    $employeeData[$key] = $value;
                }
            }

            // 7. 產生員工編號和領取 token
            $employeeData['employee_id'] = Employee::generateEmployeeId();
            $employeeData['credential_token'] = Employee::generateCredentialToken();

            // 8. 建立員工記錄
            $employee = Employee::create($employeeData);

            // 9. 標記 VP 驗證結果為已使用
            $verifierService->markVPResultAsUsed($vpTransactionId);

            // 10. 記錄 VP 驗證日誌
            ActivityLog::logVPVerification(
                transactionId: $vpTransactionId,
                reason: '應徵者使用三張前置憑證申請職位',
                success: true,
                employeeId: $employee->employee_id,
                metadata: [
                    'application' => true,
                    'position' => $employee->position,
                    'department' => $employee->department,
                ]
            );

            // 11. 記錄應徵申請日誌
            ActivityLog::log([
                'employee_id' => $employee->employee_id,
                'actor_id' => $employee->employee_id,
                'actor_type' => 'employee',
                'action' => 'apply_job',
                'action_display' => '應徵申請',
                'description' => "應徵 {$employee->position} 職位",
                'target_type' => 'application',
                'target_id' => $employee->employee_id,
                'status' => 'success',
                'metadata' => [
                    'vp_transaction_id' => $vpTransactionId,
                    'position' => $employee->position,
                    'department' => $employee->department,
                    'company_name' => $employee->company_name,
                ],
            ]);

            return response()->json([
                'success' => true,
                'message' => '應徵申請成功',
                'employee' => [
                    'employee_id' => $employee->employee_id,
                    'credential_token' => $employee->credential_token,
                    'name' => $employee->name,
                    'position' => $employee->position,
                    'department' => $employee->department,
                    'employment_start_date' => $employee->employment_start_date->format('Y-m-d'),
                ],
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '處理應徵申請時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 從 VC claims 提取資料到員工資料陣列
     */
    private function extractVCData(array $claims, array &$employeeData): void
    {
        $fieldMap = [];
        foreach ($claims as $claim) {
            $fieldMap[$claim['ename']] = $claim['value'];
        }

        // 中華民國數位身分證
        if (isset($fieldMap['id_number'])) {
            $employeeData['name'] = $fieldMap['name'] ?? null;
            $employeeData['id_number'] = $fieldMap['id_number'];
            $employeeData['roc_birthday'] = $fieldMap['roc_birthday'] ?? null;
            $employeeData['registered_address'] = $fieldMap['registered_address'] ?? null;
        }

        // 教育部數位學位證書（判斷欄位：degree_name 或 institution + major）
        if (isset($fieldMap['degree_name']) || (isset($fieldMap['institution']) && isset($fieldMap['major']))) {
            $employeeData['degree_name'] = $fieldMap['degree_name'] ?? null;
            $employeeData['degree_level'] = $fieldMap['degree_level'] ?? null;
            $employeeData['major'] = $fieldMap['major'] ?? null;
            $employeeData['graduation_date'] = $fieldMap['graduation_date'] ?? null;
            $employeeData['education_institution'] = $fieldMap['institution'] ?? null;
        }

        // 多益英文檢定證書（判斷欄位：score_listening 或 score_total）
        if (isset($fieldMap['score_listening']) || isset($fieldMap['score_total'])) {
            $employeeData['test_name'] = $fieldMap['test_name'] ?? null;
            $employeeData['test_date'] = $fieldMap['test_date'] ?? null;
            $employeeData['score_listening'] = isset($fieldMap['score_listening'])
                ? intval($fieldMap['score_listening'])
                : null;
            $employeeData['score_reading'] = isset($fieldMap['score_reading'])
                ? intval($fieldMap['score_reading'])
                : null;
            $employeeData['score_total'] = isset($fieldMap['score_total'])
                ? intval($fieldMap['score_total'])
                : null;
        }
    }
}
