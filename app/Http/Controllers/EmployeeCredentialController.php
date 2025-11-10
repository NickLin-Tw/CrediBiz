<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\IssuedVC;
use App\Models\VCStatusChangeLog;
use App\Services\TWDIWIssuerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class EmployeeCredentialController extends Controller
{
    /**
     * 取得員工資料（需要 token 驗證）
     */
    public function show(Request $request, string $employeeId)
    {
        $token = $request->query('token');

        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => '缺少驗證 token',
            ], 401);
        }

        $employee = Employee::where('employee_id', $employeeId)
            ->where('credential_token', $token)
            ->first();

        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => '找不到員工資料或 token 無效',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'employee' => [
                'employee_id' => $employee->employee_id,
                'name' => $employee->name,
                'position' => $employee->position,
                'department' => $employee->department,
                'company_name' => $employee->company_name,
                'employment_start_date' => $employee->employment_start_date?->format('Y-m-d'),
                'credential_issued' => !is_null($employee->employee_vc_cid),
            ],
        ]);
    }

    /**
     * 發行員工 VC
     */
    public function issue(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '無效的員工編號',
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

        // 檢查憑證是否已經發行
        if (!is_null($employee->employee_vc_cid)) {
            return response()->json([
                'success' => false,
                'message' => '您已經領取過員工數位憑證，無法重複領取',
            ], 400);
        }

        try {
            // 準備 VC 欄位資料
            $fields = [
                ['ename' => 'employee_id', 'content' => $employee->employee_id],
                ['ename' => 'name', 'content' => $employee->name],
                ['ename' => 'position', 'content' => $employee->position],
                ['ename' => 'department', 'content' => $employee->department],
                ['ename' => 'company_name', 'content' => $employee->company_name],
                ['ename' => 'employment_start_date', 'content' => $employee->employment_start_date->format('Y-m-d')],
            ];

            // 呼叫 TW-DIW Issuer API
            $response = Http::withHeaders([
                'Access-Token' => config('services.tw_diw.issuer_token'),
                'Content-Type' => 'application/json',
            ])->post('https://issuer-sandbox.wallet.gov.tw/api/qrcode/data', [
                'vcUid' => '00000000_vc_employee_credential',
                'fields' => $fields,
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'VC 發行失敗',
                    'error' => $response->json(),
                ], 400);
            }

            $data = $response->json();

            return response()->json([
                'success' => true,
                'transactionId' => $data['transactionId'] ?? null,
                'qrCode' => $data['qrCode'] ?? null,
                'deepLink' => $data['deepLink'] ?? null,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '發行 VC 時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 更新員工憑證資料
     */
    public function updateCredential(Request $request, string $employeeId)
    {
        $validator = Validator::make($request->all(), [
            'employee_vc_transaction_id' => 'required|string',
            'employee_vc_cid' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '無效的憑證資料',
                'errors' => $validator->errors(),
            ], 422);
        }

        $employee = Employee::where('employee_id', $employeeId)->first();

        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => '找不到員工資料',
            ], 404);
        }

        try {
            $transactionId = $request->input('employee_vc_transaction_id');
            $vcCid = $request->input('employee_vc_cid');

            $employee->update([
                'employee_vc_transaction_id' => $transactionId,
                'employee_vc_cid' => $vcCid,
                'employee_vc_issued_at' => now(),
                'employee_vc_expiry_date' => now()->addYear(),
            ]);

            // 記錄發行的 VC
            IssuedVC::create([
                'employee_id' => $employee->employee_id,
                'vc_cid' => $vcCid,
                'vc_uid' => '00000000_vc_employee_credential',
                'transaction_id' => $transactionId,
            ]);

            return response()->json([
                'success' => true,
                'message' => '員工憑證資料已更新',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '更新憑證資料時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 換發員工 VC（需要登入）
     */
    public function reissue(Request $request, TWDIWIssuerService $issuerService)
    {
        $employee = $request->user();

        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => '未登入',
            ], 401);
        }

        // 檢查是否已有憑證
        if (!$employee->employee_vc_cid) {
            return response()->json([
                'success' => false,
                'message' => '您尚未領取過員工憑證，無法進行換發',
            ], 400);
        }

        try {
            $oldCid = $employee->employee_vc_cid;

            // 準備 VC 欄位資料
            $fields = [
                ['ename' => 'employee_id', 'content' => $employee->employee_id],
                ['ename' => 'name', 'content' => $employee->name],
                ['ename' => 'position', 'content' => $employee->position],
                ['ename' => 'department', 'content' => $employee->department],
                ['ename' => 'company_name', 'content' => $employee->company_name],
                ['ename' => 'employment_start_date', 'content' => $employee->employment_start_date->format('Y-m-d')],
            ];

            // 發行新的 VC
            $response = Http::withHeaders([
                'Access-Token' => config('services.tw_diw.issuer_token'),
                'Content-Type' => 'application/json',
            ])->post('https://issuer-sandbox.wallet.gov.tw/api/qrcode/data', [
                'vcUid' => '00000000_vc_employee_credential',
                'fields' => $fields,
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => '新憑證發行失敗',
                    'error' => $response->json(),
                ], 400);
            }

            $data = $response->json();

            return response()->json([
                'success' => true,
                'transactionId' => $data['transactionId'] ?? null,
                'qrCode' => $data['qrCode'] ?? null,
                'deepLink' => $data['deepLink'] ?? null,
                'oldCid' => $oldCid,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '換發憑證時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 確認換發憑證（revoke 舊卡、更新新卡資料）
     */
    public function confirmReissue(Request $request, TWDIWIssuerService $issuerService)
    {
        $validator = Validator::make($request->all(), [
            'new_vc_transaction_id' => 'required|string',
            'new_vc_cid' => 'required|string',
            'old_vc_cid' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '無效的憑證資料',
                'errors' => $validator->errors(),
            ], 422);
        }

        $employee = $request->user();

        if (!$employee) {
            return response()->json([
                'success' => false,
                'message' => '未登入',
            ], 401);
        }

        $oldCid = $request->input('old_vc_cid');
        $newCid = $request->input('new_vc_cid');
        $newTransactionId = $request->input('new_vc_transaction_id');

        // 驗證舊 CID 是否正確
        if ($employee->employee_vc_cid !== $oldCid) {
            return response()->json([
                'success' => false,
                'message' => '舊憑證 CID 不符',
            ], 400);
        }

        try {
            // Revoke 舊的 VC
            $revokeResponse = $issuerService->changeVCStatus($oldCid, 'revocation');

            // 記錄 VC 狀態變更 log
            VCStatusChangeLog::create([
                'employee_id' => $employee->employee_id,
                'action' => 'revocation',
                'reason' => '換發員工憑證（更換裝置）',
                'old_vc_cid' => $oldCid,
                'new_vc_cid' => $newCid,
                'vc_uid' => '00000000_vc_employee_credential',
                'transaction_id' => $newTransactionId,
                'response_data' => $revokeResponse,
            ]);

            // 更新員工憑證資料
            $employee->update([
                'employee_vc_transaction_id' => $newTransactionId,
                'employee_vc_cid' => $newCid,
                'employee_vc_issued_at' => now(),
                'employee_vc_expiry_date' => now()->addYear(),
            ]);

            // 記錄新發行的 VC
            IssuedVC::create([
                'employee_id' => $employee->employee_id,
                'vc_cid' => $newCid,
                'vc_uid' => '00000000_vc_employee_credential',
                'transaction_id' => $newTransactionId,
            ]);

            return response()->json([
                'success' => true,
                'message' => '憑證換發成功',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '確認換發時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
