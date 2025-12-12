<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\EmployeeLoginLog;
use App\Models\IssuedVC;
use App\Models\MedicalLeave;
use App\Models\VPVerificationResult;
use App\Models\VCStatusChangeLog;
use App\Models\ActivityLog;
use App\Services\TWDIWIssuerService;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * 顯示後台主頁面
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): \Illuminate\Contracts\View\View
    {
        /** @var view-string $viewName */
        $viewName = 'admin.dashboard';
        return view($viewName);
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

            // 記錄活動日誌
            ActivityLog::logVCRevoke(
                employeeId: $employee->employee_id,
                vcCid: $oldCid,
                reason: $request->reason,
                actorId: 'admin',
                actorType: 'admin'
            );

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

    /**
     * 取得病假申請記錄
     */
    public function getMedicalLeaves(Request $request)
    {
        $query = MedicalLeave::with(['employee', 'vpVerification'])
            ->orderBy('created_at', 'desc');

        if ($request->has('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        $leaves = $query->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $leaves->items(),
            'meta' => [
                'current_page' => $leaves->currentPage(),
                'last_page' => $leaves->lastPage(),
                'per_page' => $leaves->perPage(),
                'total' => $leaves->total(),
            ],
        ]);
    }

    /**
     * 取得病假 VP 驗證記錄
     */
    public function getMedicalLeaveVPLogs(Request $request)
    {
        $query = VPVerificationResult::with('employee')
            ->where('vp_type', 'medical_leave')
            ->orderBy('verified_at', 'desc');

        if ($request->has('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        $logs = $query->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $logs->items(),
            'meta' => [
                'current_page' => $logs->currentPage(),
                'last_page' => $logs->lastPage(),
                'per_page' => $logs->perPage(),
                'total' => $logs->total(),
            ],
        ]);
    }

    /**
     * 取得活動日誌
     */
    public function getActivityLogs(Request $request)
    {
        $query = ActivityLog::with(['employee', 'actor'])
            ->orderBy('created_at', 'desc');

        // 篩選：員工 ID
        if ($request->has('employee_id') && $request->employee_id) {
            $query->where('employee_id', $request->employee_id);
        }

        // 篩選：操作者 ID
        if ($request->has('actor_id') && $request->actor_id) {
            $query->where('actor_id', $request->actor_id);
        }

        // 篩選：行為類型
        if ($request->has('action') && $request->action) {
            $query->where('action', $request->action);
        }

        // 篩選：狀態
        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }

        // 篩選：日期範圍
        if ($request->has('start_date') && $request->start_date) {
            $query->where('created_at', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date) {
            $query->where('created_at', '<=', $request->end_date . ' 23:59:59');
        }

        $logs = $query->paginate($request->input('per_page', 50));

        return response()->json([
            'success' => true,
            'data' => $logs->items(),
            'meta' => [
                'current_page' => $logs->currentPage(),
                'last_page' => $logs->lastPage(),
                'per_page' => $logs->perPage(),
                'total' => $logs->total(),
            ],
        ]);
    }

    /**
     * 取得活動日誌統計
     */
    public function getActivityStats(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = ActivityLog::query();

        if ($startDate) {
            $query->where('created_at', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('created_at', '<=', $endDate . ' 23:59:59');
        }

        // 按行為類型統計
        $actionStats = (clone $query)
            ->selectRaw('action, action_display, COUNT(*) as count')
            ->groupBy('action', 'action_display')
            ->orderBy('count', 'desc')
            ->get();

        // 按狀態統計
        $statusStats = (clone $query)
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        // 按操作者類型統計
        $actorTypeStats = (clone $query)
            ->selectRaw('actor_type, COUNT(*) as count')
            ->groupBy('actor_type')
            ->get();

        // 總數
        $totalLogs = $query->count();

        return response()->json([
            'success' => true,
            'data' => [
                'total_logs' => $totalLogs,
                'action_stats' => $actionStats,
                'status_stats' => $statusStats,
                'actor_type_stats' => $actorTypeStats,
            ],
        ]);
    }
}
