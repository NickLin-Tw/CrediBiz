<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MedicalLeave;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminMedicalLeaveController extends Controller
{
    /**
     * 取得病假申請列表（含搜尋、篩選）
     */
    public function index(Request $request)
    {
        $query = MedicalLeave::with(['employee', 'vpVerification']);

        // 搜尋：員工編號或姓名
        if ($search = $request->input('search')) {
            $query->whereHas('employee', function ($q) use ($search) {
                $q->where('employee_id', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%");
            });
        }

        // 篩選：審核狀態
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // 篩選：日期範圍
        if ($startDate = $request->input('start_date')) {
            $query->where('leave_start_date', '>=', $startDate);
        }
        if ($endDate = $request->input('end_date')) {
            $query->where('leave_end_date', '<=', $endDate);
        }

        // 排序
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // 分頁
        $perPage = $request->input('per_page', 15);
        $medicalLeaves = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'medical_leaves' => $medicalLeaves,
        ]);
    }

    /**
     * 取得病假申請詳細資料（含 VP 驗證資料）
     */
    public function show(int $id)
    {
        $medicalLeave = MedicalLeave::with(['employee', 'vpVerification'])
            ->find($id);

        if (!$medicalLeave) {
            return response()->json([
                'success' => false,
                'message' => '找不到病假申請資料',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'medical_leave' => $medicalLeave,
        ]);
    }

    /**
     * 審核病假申請（通過）
     */
    public function approve(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'review_note' => 'nullable|string|max:1000',
            'reviewed_by' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '驗證失敗',
                'errors' => $validator->errors(),
            ], 422);
        }

        $medicalLeave = MedicalLeave::with('employee')->find($id);

        if (!$medicalLeave) {
            return response()->json([
                'success' => false,
                'message' => '找不到病假申請資料',
            ], 404);
        }

        if ($medicalLeave->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => '該申請已經過審核',
            ], 400);
        }

        try {
            $medicalLeave->update([
                'status' => 'approved',
                'reviewed_by' => $request->input('reviewed_by'),
                'reviewed_at' => now(),
                'review_note' => $request->input('review_note'),
            ]);

            // 記錄活動日誌
            ActivityLog::log([
                'employee_id' => $medicalLeave->employee_id,
                'actor_id' => $request->input('reviewed_by'),
                'actor_type' => 'admin',
                'action' => 'approve_medical_leave',
                'action_display' => '核准病假',
                'description' => "核准病假申請（{$medicalLeave->leave_days} 天）",
                'target_type' => 'medical_leave',
                'target_id' => (string) $medicalLeave->id,
                'status' => 'success',
                'metadata' => [
                    'leave_start_date' => $medicalLeave->leave_start_date->format('Y-m-d'),
                    'leave_end_date' => $medicalLeave->leave_end_date->format('Y-m-d'),
                    'leave_days' => $medicalLeave->leave_days,
                    'review_note' => $request->input('review_note'),
                ],
            ]);

            return response()->json([
                'success' => true,
                'message' => '病假申請已核准',
                'medical_leave' => $medicalLeave,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '核准病假時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 審核病假申請（不通過）
     */
    public function reject(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'review_note' => 'required|string|max:1000',
            'reviewed_by' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '驗證失敗',
                'errors' => $validator->errors(),
            ], 422);
        }

        $medicalLeave = MedicalLeave::with('employee')->find($id);

        if (!$medicalLeave) {
            return response()->json([
                'success' => false,
                'message' => '找不到病假申請資料',
            ], 404);
        }

        if ($medicalLeave->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => '該申請已經過審核',
            ], 400);
        }

        try {
            $medicalLeave->update([
                'status' => 'rejected',
                'reviewed_by' => $request->input('reviewed_by'),
                'reviewed_at' => now(),
                'review_note' => $request->input('review_note'),
            ]);

            // 記錄活動日誌
            ActivityLog::log([
                'employee_id' => $medicalLeave->employee_id,
                'actor_id' => $request->input('reviewed_by'),
                'actor_type' => 'admin',
                'action' => 'reject_medical_leave',
                'action_display' => '駁回病假',
                'description' => "駁回病假申請：{$request->input('review_note')}",
                'target_type' => 'medical_leave',
                'target_id' => (string) $medicalLeave->id,
                'status' => 'success',
                'metadata' => [
                    'leave_start_date' => $medicalLeave->leave_start_date->format('Y-m-d'),
                    'leave_end_date' => $medicalLeave->leave_end_date->format('Y-m-d'),
                    'leave_days' => $medicalLeave->leave_days,
                    'review_note' => $request->input('review_note'),
                ],
            ]);

            return response()->json([
                'success' => true,
                'message' => '病假申請已駁回',
                'medical_leave' => $medicalLeave,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '駁回病假時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 取得統計資料
     */
    public function statistics(Request $request)
    {
        $startDate = $request->input('start_date', now()->subMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $query = MedicalLeave::whereBetween('created_at', [$startDate, $endDate]);

        $stats = [
            'total' => $query->count(),
            'pending' => (clone $query)->where('status', 'pending')->count(),
            'approved' => (clone $query)->where('status', 'approved')->count(),
            'rejected' => (clone $query)->where('status', 'rejected')->count(),
            'total_leave_days' => (clone $query)->where('status', 'approved')->sum('leave_days'),
        ];

        return response()->json([
            'success' => true,
            'statistics' => $stats,
            'date_range' => [
                'start_date' => $startDate,
                'end_date' => $endDate,
            ],
        ]);
    }
}
