<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeLoginLog;
use App\Models\IssuedVC;
use App\Models\VPVerificationResult;
use App\Models\VCStatusChangeLog;
use App\Services\TWDIWIssuerService;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * 顯示後台主頁面
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    /**
     * 取得登入記錄
     */
    public function getLoginLogs(Request $request)
    {
        $query = EmployeeLoginLog::with('employee')
            ->orderBy('created_at', 'desc');

        if ($request->has('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        $logs = $query->paginate(20);

        return response()->json($logs);
    }

    /**
     * 取得 VC 發行記錄
     */
    public function getVCIssuedLogs(Request $request)
    {
        $query = IssuedVC::orderBy('created_at', 'desc');

        if ($request->has('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        $logs = $query->paginate(20);

        return response()->json($logs);
    }

    /**
     * 取得 VP 驗證記錄
     */
    public function getVPVerificationLogs(Request $request)
    {
        $query = VPVerificationResult::orderBy('created_at', 'desc');

        if ($request->has('transaction_id')) {
            $query->where('transaction_id', $request->transaction_id);
        }

        $logs = $query->paginate(20);

        return response()->json($logs);
    }

    /**
     * 取得 VC 狀態變更記錄
     */
    public function getVCStatusChangeLogs(Request $request)
    {
        $query = VCStatusChangeLog::with('employee')
            ->orderBy('created_at', 'desc');

        if ($request->has('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        $logs = $query->paginate(20);

        return response()->json($logs);
    }

    /**
     * 取得員工列表
     */
    public function getEmployees(Request $request)
    {
        $query = Employee::orderBy('employee_id', 'asc');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('employee_id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%");
            });
        }

        $employees = $query->paginate(20);

        return response()->json($employees);
    }

    /**
     * 撤銷員工憑證
     */
    public function revokeCredential(Request $request, TWDIWIssuerService $issuerService)
    {
        $request->validate([
            'employee_id' => 'required|string',
            'reason' => 'required|string',
        ]);

        $employee = Employee::where('employee_id', $request->employee_id)->firstOrFail();

        if (!$employee->employee_vc_cid) {
            return response()->json([
                'success' => false,
                'message' => '該員工尚未領取憑證',
            ], 400);
        }

        try {
            $oldCid = $employee->employee_vc_cid;

            // 撤銷憑證
            $revokeResponse = $issuerService->changeVCStatus($oldCid, 'revocation');

            // 記錄狀態變更
            VCStatusChangeLog::create([
                'employee_id' => $employee->employee_id,
                'action' => 'revocation',
                'reason' => $request->reason,
                'old_vc_cid' => $oldCid,
                'new_vc_cid' => null,
                'vc_uid' => '00000000_vc_employee_credential',
                'transaction_id' => null,
                'response_data' => $revokeResponse,
            ]);

            // 清除員工憑證資料
            $employee->update([
                'employee_vc_cid' => null,
                'employee_vc_transaction_id' => null,
                'employee_vc_issued_at' => null,
                'employee_vc_expiry_date' => null,
            ]);

            return response()->json([
                'success' => true,
                'message' => '憑證已成功撤銷',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '撤銷憑證時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 為員工重新發行憑證（管理員操作）
     */
    public function reissueCredential(Request $request, TWDIWIssuerService $issuerService)
    {
        $request->validate([
            'employee_id' => 'required|string',
        ]);

        $employee = Employee::where('employee_id', $request->employee_id)->firstOrFail();

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
            $result = $issuerService->issueVC(
                vcUid: '00000000_vc_employee_credential',
                fields: $fields
            );

            return response()->json([
                'success' => true,
                'transactionId' => $result['transactionId'],
                'qrCode' => $result['qrCode'],
                'deepLink' => $result['deepLink'],
                'oldCid' => $oldCid,
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '發行憑證時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
