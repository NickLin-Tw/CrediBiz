<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VisitorParkingApplication;
use App\Models\ActivityLog;
use App\Services\TWDIWIssuerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminVisitorParkingController extends Controller
{
    /**
     * 管理員代為申請訪客停車證
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'application_reason' => 'required|string',
            'vehicle_plate_number' => 'required|string',
            'vehicle_type' => 'required|string',
            'brand_model' => 'required|string',
            'color' => 'required|string',
            'parking_start_date' => 'required|date',
            'parking_end_date' => 'required|date|after_or_equal:parking_start_date',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '表單驗證失敗',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            // 產生訪客 token
            $visitorToken = \App\Models\VisitorParkingApplication::generateVisitorToken();

            // 建立申請記錄（直接設為待審核狀態）
            $application = \App\Models\VisitorParkingApplication::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'application_reason' => $request->input('application_reason'),
                'vehicle_plate_number' => $request->input('vehicle_plate_number'),
                'vehicle_type' => $request->input('vehicle_type'),
                'brand_model' => $request->input('brand_model'),
                'color' => $request->input('color'),
                'parking_start_date' => $request->input('parking_start_date'),
                'parking_end_date' => $request->input('parking_end_date'),
                'visitor_token' => $visitorToken,
                'status' => 'pending',
            ]);

            // 記錄活動日誌
            ActivityLog::log([
                'employee_id' => null,
                'actor_id' => '1', // TODO: 從 session 取得管理員 ID
                'actor_type' => 'admin',
                'action' => 'create_visitor_parking',
                'action_display' => '管理員代為申請訪客停車證',
                'description' => "管理員為訪客 {$application->email} 建立停車證申請",
                'target_type' => 'visitor_parking',
                'target_id' => (string) $application->id,
                'status' => 'success',
                'metadata' => [
                    'email' => $application->email,
                    'parking_dates' => "{$application->parking_start_date} ~ {$application->parking_end_date}",
                ],
            ]);

            return response()->json([
                'success' => true,
                'message' => '訪客停車證申請已建立',
                'data' => [
                    'id' => $application->id,
                    'visitor_token' => $visitorToken,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '建立申請時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 列出所有訪客停車證申請
     */
    public function index(Request $request)
    {
        $query = VisitorParkingApplication::with('reviewer');

        // 狀態篩選（只有當 status 有值且不為空字串時才篩選）
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // 電子郵件搜尋
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        // 排序
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // 分頁
        $perPage = $request->input('per_page', 20);
        $applications = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $applications->map(function ($app) {
                return [
                    'id' => $app->id,
                    'name' => $app->name,
                    'email' => $app->email,
                    'vehicle_plate_number' => $app->vehicle_plate_number,
                    'vehicle_type' => $app->vehicle_type,
                    'brand_model' => $app->brand_model,
                    'color' => $app->color,
                    'parking_start_date' => $app->parking_start_date->format('Y-m-d'),
                    'parking_end_date' => $app->parking_end_date->format('Y-m-d'),
                    'application_reason' => $app->application_reason,
                    'status' => $app->status,
                    'status_text' => $app->status_text,
                    'permit_id' => $app->permit_id,
                    'is_issued' => $app->is_issued,
                    'reviewed_by' => $app->reviewed_by,
                    'reviewer_name' => $app->reviewer?->name,
                    'reviewed_at' => $app->reviewed_at?->format('Y-m-d H:i:s'),
                    'created_at' => $app->created_at->format('Y-m-d H:i:s'),
                ];
            }),
            'meta' => [
                'current_page' => $applications->currentPage(),
                'last_page' => $applications->lastPage(),
                'per_page' => $applications->perPage(),
                'total' => $applications->total(),
            ],
        ]);
    }

    /**
     * 查看單一申請詳情
     */
    public function show(int $id)
    {
        $application = VisitorParkingApplication::with('reviewer')->findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $application->id,
                'name' => $application->name,
                'email' => $application->email,
                'application_reason' => $application->application_reason,
                'vehicle_plate_number' => $application->vehicle_plate_number,
                'vehicle_type' => $application->vehicle_type,
                'brand_model' => $application->brand_model,
                'color' => $application->color,
                'parking_start_date' => $application->parking_start_date->format('Y-m-d'),
                'parking_end_date' => $application->parking_end_date->format('Y-m-d'),
                'status' => $application->status,
                'status_text' => $application->status_text,
                'permit_id' => $application->permit_id,
                'claim_url' => $application->claim_url,
                'qr_code' => $application->qr_code,
                'deep_link' => $application->deep_link,
                'is_issued' => $application->is_issued,
                'issued_at' => $application->issued_at?->format('Y-m-d H:i:s'),
                'reviewed_by' => $application->reviewed_by,
                'reviewer_name' => $application->reviewer?->name,
                'reviewed_at' => $application->reviewed_at?->format('Y-m-d H:i:s'),
                'review_note' => $application->review_note,
                'created_at' => $application->created_at->format('Y-m-d H:i:s'),
            ],
        ]);
    }

    /**
     * 核准申請並發行停車證 VC
     */
    public function approve(Request $request, int $id, TWDIWIssuerService $issuerService)
    {
        $validator = Validator::make($request->all(), [
            'review_note' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '表單驗證失敗',
                'errors' => $validator->errors(),
            ], 422);
        }

        $application = VisitorParkingApplication::findOrFail($id);

        if ($application->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => '此申請已處理過',
            ], 400);
        }

        try {
            // 產生停車證編號
            $permitId = VisitorParkingApplication::generatePermitId();

            // 發行停車證 VC
            $vcResult = $issuerService->issueVC(
                vcUid: '00000000_vc_parking_permit',
                fields: [
                    'name' => $application->name ?: $application->email,  // 使用訪客姓名，若無則用 email
                    'permid_id' => $permitId,  // 符合 TW-DIW 模板定義
                    'parking_type' => '訪客臨時停車',
                ],
                issuanceDate: $application->parking_start_date->format('Ymd'),
                expiredDate: $application->parking_end_date->format('Ymd')
            );

            // 更新申請記錄
            $application->update([
                'status' => 'approved',
                'reviewed_by' => '1', // TODO: 從 session 取得管理員 ID
                'reviewed_at' => now(),
                'review_note' => $request->input('review_note'),
                'permit_id' => $permitId,
                'vc_transaction_id' => $vcResult['transactionId'],
                'qr_code' => $vcResult['qrCode'],
                'deep_link' => $vcResult['deepLink'] ?? null,
            ]);

            // 記錄活動日誌
            ActivityLog::log([
                'employee_id' => null,
                'actor_id' => '1', // TODO: 從 session 取得管理員 ID
                'actor_type' => 'admin',
                'action' => 'approve_visitor_parking',
                'action_display' => '核准訪客停車證申請',
                'description' => "核准訪客 {$application->email} 的停車證申請（{$permitId}）",
                'target_type' => 'visitor_parking',
                'target_id' => (string) $application->id,
                'status' => 'success',
                'metadata' => [
                    'permit_id' => $permitId,
                    'email' => $application->email,
                ],
            ]);

            return response()->json([
                'success' => true,
                'message' => '申請已核准並發行停車證',
                'data' => [
                    'permit_id' => $permitId,
                    'claim_url' => $application->claim_url,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '核准申請時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 拒絕申請
     */
    public function reject(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'review_note' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '請填寫拒絕原因',
                'errors' => $validator->errors(),
            ], 422);
        }

        $application = VisitorParkingApplication::findOrFail($id);

        if ($application->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => '此申請已處理過',
            ], 400);
        }

        try {
            $application->update([
                'status' => 'rejected',
                'reviewed_by' => '1', // TODO: 從 session 取得管理員 ID
                'reviewed_at' => now(),
                'review_note' => $request->input('review_note'),
            ]);

            // 記錄活動日誌
            ActivityLog::log([
                'employee_id' => null,
                'actor_id' => '1', // TODO: 從 session 取得管理員 ID
                'actor_type' => 'admin',
                'action' => 'reject_visitor_parking',
                'action_display' => '拒絕訪客停車證申請',
                'description' => "拒絕訪客 {$application->email} 的停車證申請",
                'target_type' => 'visitor_parking',
                'target_id' => (string) $application->id,
                'status' => 'success',
                'metadata' => [
                    'email' => $application->email,
                    'reason' => $request->input('review_note'),
                ],
            ]);

            return response()->json([
                'success' => true,
                'message' => '已拒絕申請',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '拒絕申請時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * 統計資訊
     */
    public function statistics(Request $request)
    {
        $totalApplications = VisitorParkingApplication::count();
        $pendingCount = VisitorParkingApplication::where('status', 'pending')->count();
        $approvedCount = VisitorParkingApplication::where('status', 'approved')->count();
        $rejectedCount = VisitorParkingApplication::where('status', 'rejected')->count();
        $issuedCount = VisitorParkingApplication::where('is_issued', true)->count();

        return response()->json([
            'success' => true,
            'data' => [
                'total' => $totalApplications,
                'pending' => $pendingCount,
                'approved' => $approvedCount,
                'rejected' => $rejectedCount,
                'issued' => $issuedCount,
            ],
        ]);
    }
}
