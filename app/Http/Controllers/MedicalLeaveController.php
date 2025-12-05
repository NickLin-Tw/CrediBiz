<?php

namespace App\Http\Controllers;

use App\Models\MedicalLeave;
use App\Models\VPVerificationResult;
use App\Models\ActivityLog;
use App\Services\TWDIWVerifierService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class MedicalLeaveController extends Controller
{
    /**
     * 驗證醫療診斷證明 VP 並提取資料
     */
    public function verifyMedicalCertificate(Request $request, TWDIWVerifierService $verifierService)
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
            // 先嘗試從資料庫取得已儲存的 VP 結果
            $vpResult = $verifierService->getStoredVPResult($vpTransactionId);

            // 如果資料庫沒有，從 TW-DIW 取得（會自動儲存）
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

            // 解析 VP 資料
            $credentials = $vpResult['data'] ?? [];
            $employeeCredential = null;
            $medicalCertificate = null;

            foreach ($credentials as $credential) {
                $credentialType = $credential['credentialType'] ?? '';

                if ($credentialType === '00000000_vc_employee_credential') {
                    $employeeCredential = $credential;
                } elseif ($credentialType === '00000000_vc_medical_diagnosis_certificate') {
                    $medicalCertificate = $credential;
                }
            }

            // 檢查是否有員工憑證和醫療診斷證明
            if (!$employeeCredential || !$medicalCertificate) {
                $this->saveVPVerificationLog($vpTransactionId, $employee->employee_id, false, '缺少必要的憑證', $vpResult);

                return response()->json([
                    'success' => false,
                    'message' => '缺少必要的憑證（員工證或醫療診斷證明）',
                ], 400);
            }

            // 解析員工憑證
            $employeeData = $this->parseClaimsToArray($employeeCredential['claims'] ?? []);
            $employeeName = $employeeData['name'] ?? '';

            // 檢查員工姓名是否與登入者一致
            if ($employeeName !== $employee->name) {
                $this->saveVPVerificationLog($vpTransactionId, $employee->employee_id, false, '員工姓名與登入者不符', $vpResult);

                return response()->json([
                    'success' => false,
                    'message' => '員工姓名與登入者不符',
                    'details' => "VP 中的姓名：{$employeeName}，登入者：{$employee->name}",
                ], 400);
            }

            // 檢查 VP 是否已被使用過（重複提交）
            $existingLeave = MedicalLeave::where('vp_transaction_id', $vpTransactionId)->first();
            if ($existingLeave) {
                $this->saveVPVerificationLog($vpTransactionId, $employee->employee_id, false, '此 VP 已被使用過（重複提交）', $vpResult);

                return response()->json([
                    'success' => false,
                    'message' => '此醫療證明已被使用過，不可重複提交',
                ], 400);
            }

            // 解析醫療診斷證明
            $medicalData = $this->parseClaimsToArray($medicalCertificate['claims'] ?? []);

            // 保存 VP 驗證成功記錄
            $this->saveVPVerificationLog($vpTransactionId, $employee->employee_id, true, 'VP 驗證成功', $vpResult);

            // 記錄活動日誌
            ActivityLog::logVPVerification(
                transactionId: $vpTransactionId,
                reason: '員工驗證醫療診斷證明憑證（病假申請）',
                success: true,
                employeeId: $employee->employee_id,
                metadata: [
                    'medical_leave' => true,
                    'hospital_name' => $medicalData['hospital_name'] ?? null,
                ]
            );

            // 回傳提取的資料
            return response()->json([
                'success' => true,
                'message' => 'VP 驗證成功',
                'data' => [
                    'vp_transaction_id' => $vpTransactionId,
                    'rest_start_date' => $medicalData['rest_start_date'] ?? null,
                    'rest_end_date' => $medicalData['rest_end_date'] ?? null,
                    'hospital_name' => $medicalData['hospital_name'] ?? null,
                    'doctor_name' => $medicalData['doctor_name'] ?? null,
                    'doctor_recommendation' => $medicalData['recommendation'] ?? null,
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
     * 提交病假申請
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vp_transaction_id' => 'required|string|uuid',
            'rest_start_date' => 'required|date',
            'rest_end_date' => 'required|date|after_or_equal:rest_start_date',
            'leave_start_date' => 'required|date',
            'leave_end_date' => 'required|date|after_or_equal:leave_start_date',
            'hospital_name' => 'nullable|string',
            'doctor_name' => 'nullable|string',
            'doctor_recommendation' => 'nullable|string',
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

        try {
            // 檢查 VP 是否已被使用
            $existingLeave = MedicalLeave::where('vp_transaction_id', $vpTransactionId)->first();
            if ($existingLeave) {
                return response()->json([
                    'success' => false,
                    'message' => '此醫療證明已被使用過，不可重複提交',
                ], 400);
            }

            // 驗證請假起始日不能早於建議休養起始日
            $restStartDate = Carbon::parse($request->input('rest_start_date'));
            $leaveStartDate = Carbon::parse($request->input('leave_start_date'));

            if ($leaveStartDate->lt($restStartDate)) {
                return response()->json([
                    'success' => false,
                    'message' => '請假起始日不能早於建議休養起始日',
                ], 400);
            }

            // 計算請假天數
            $leaveEndDate = Carbon::parse($request->input('leave_end_date'));
            $leaveDays = $leaveStartDate->diffInDays($leaveEndDate) + 1;

            // 建立病假記錄
            $medicalLeave = MedicalLeave::create([
                'employee_id' => $employee->employee_id,
                'vp_transaction_id' => $vpTransactionId,
                'rest_start_date' => $request->input('rest_start_date'),
                'rest_end_date' => $request->input('rest_end_date'),
                'leave_start_date' => $request->input('leave_start_date'),
                'leave_end_date' => $request->input('leave_end_date'),
                'leave_days' => $leaveDays,
                'hospital_name' => $request->input('hospital_name'),
                'doctor_name' => $request->input('doctor_name'),
                'doctor_recommendation' => $request->input('doctor_recommendation'),
            ]);

            // 標記 VP 為已使用
            VPVerificationResult::where('transaction_id', $vpTransactionId)
                ->update(['is_used' => true]);

            // 記錄活動日誌
            ActivityLog::log([
                'employee_id' => $employee->employee_id,
                'actor_id' => $employee->employee_id,
                'actor_type' => 'employee',
                'action' => 'apply_leave',
                'action_display' => '申請病假',
                'description' => "申請病假 {$leaveDays} 天（{$request->input('leave_start_date')} ~ {$request->input('leave_end_date')}）",
                'target_type' => 'leave',
                'target_id' => (string) $medicalLeave->id,
                'status' => 'success',
                'metadata' => [
                    'vp_transaction_id' => $vpTransactionId,
                    'leave_days' => $leaveDays,
                    'hospital_name' => $request->input('hospital_name'),
                ],
            ]);

            return response()->json([
                'success' => true,
                'message' => '病假申請提交成功',
                'data' => [
                    'id' => $medicalLeave->id,
                    'employee_id' => $medicalLeave->employee_id,
                    'leave_start_date' => $medicalLeave->leave_start_date->format('Y-m-d'),
                    'leave_end_date' => $medicalLeave->leave_end_date->format('Y-m-d'),
                    'leave_days' => $medicalLeave->leave_days,
                ],
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '提交申請時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 獲取當前員工的病假列表
     */
    public function index(Request $request)
    {
        $employee = $request->user();

        $leaves = MedicalLeave::where('employee_id', $employee->employee_id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($leave) {
                return [
                    'id' => $leave->id,
                    'leave_start_date' => $leave->leave_start_date->format('Y-m-d'),
                    'leave_end_date' => $leave->leave_end_date->format('Y-m-d'),
                    'leave_days' => $leave->leave_days,
                    'rest_start_date' => $leave->rest_start_date->format('Y-m-d'),
                    'rest_end_date' => $leave->rest_end_date->format('Y-m-d'),
                    'hospital_name' => $leave->hospital_name,
                    'doctor_name' => $leave->doctor_name,
                    'created_at' => $leave->created_at->format('Y-m-d H:i:s'),
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $leaves,
        ]);
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

    /**
     * 保存 VP 驗證記錄
     */
    private function saveVPVerificationLog(
        string $transactionId,
        string $employeeId,
        bool $success,
        string $reason,
        array $vpResult
    ): void {
        VPVerificationResult::updateOrCreate(
            ['transaction_id' => $transactionId],
            [
                'employee_id' => $employeeId,
                'vp_type' => 'medical_leave',
                'verify_result' => $vpResult['verifyResult'] ?? false,
                'result_description' => $vpResult['resultDescription'] ?? null,
                'rejection_reason' => $success ? null : $reason,
                'credentials' => $vpResult['data'] ?? [],
                'full_response' => $vpResult,
                'verified_at' => now(),
            ]
        );
    }
}
