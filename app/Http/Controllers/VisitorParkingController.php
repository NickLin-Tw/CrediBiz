<?php

namespace App\Http\Controllers;

use App\Models\VisitorParkingApplication;
use App\Models\IssuedVC;
use App\Services\TWDIWIssuerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VisitorParkingController extends Controller
{
    /**
     * 提交訪客停車證申請
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
            'parking_start_date' => 'required|date|after_or_equal:today',
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
            // 建立申請記錄
            $application = VisitorParkingApplication::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'application_reason' => $request->input('application_reason'),
                'vehicle_plate_number' => $request->input('vehicle_plate_number'),
                'vehicle_type' => $request->input('vehicle_type'),
                'brand_model' => $request->input('brand_model'),
                'color' => $request->input('color'),
                'parking_start_date' => $request->input('parking_start_date'),
                'parking_end_date' => $request->input('parking_end_date'),
                'visitor_token' => VisitorParkingApplication::generateVisitorToken(),
            ]);

            return response()->json([
                'success' => true,
                'message' => '申請已送出，請等待審核。審核結果將寄送至您的電子郵件。',
                'data' => [
                    'id' => $application->id,
                    'email' => $application->email,
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
     * 查看申請資訊（透過 visitor_token）
     */
    public function show(string $visitorToken)
    {
        $application = VisitorParkingApplication::where('visitor_token', $visitorToken)->first();

        if (!$application) {
            return response()->json([
                'success' => false,
                'message' => '找不到申請記錄',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $application->id,
                'name' => $application->name,
                'email' => $application->email,
                'vehicle_plate_number' => $application->vehicle_plate_number,
                'vehicle_type' => $application->vehicle_type,
                'brand_model' => $application->brand_model,
                'color' => $application->color,
                'parking_start_date' => $application->parking_start_date->format('Y-m-d'),
                'parking_end_date' => $application->parking_end_date->format('Y-m-d'),
                'status' => $application->status,
                'status_text' => $application->status_text,
                'permit_id' => $application->permit_id,
                'qr_code' => $application->qr_code,
                'deep_link' => $application->deep_link,
                'is_issued' => $application->is_issued,
            ],
        ]);
    }

    /**
     * 訪客領取停車證（確認領取）
     */
    public function claim(Request $request, string $visitorToken, TWDIWIssuerService $issuerService)
    {
        $validator = Validator::make($request->all(), [
            'vc_cid' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => '無效的憑證資料',
                'errors' => $validator->errors(),
            ], 422);
        }

        $application = VisitorParkingApplication::where('visitor_token', $visitorToken)->first();

        if (!$application) {
            return response()->json([
                'success' => false,
                'message' => '找不到申請記錄',
            ], 404);
        }

        if ($application->status !== 'approved') {
            return response()->json([
                'success' => false,
                'message' => '此申請尚未核准',
            ], 400);
        }

        if ($application->is_issued) {
            return response()->json([
                'success' => false,
                'message' => '停車證已領取過',
            ], 400);
        }

        try {
            $vcCid = $request->input('vc_cid');

            // 更新申請記錄
            $application->update([
                'vc_cid' => $vcCid,
                'is_issued' => true,
                'issued_at' => now(),
            ]);

            // 記錄已發行的 VC（employee_id 為 null 表示訪客）
            IssuedVC::create([
                'employee_id' => null,
                'vc_cid' => $vcCid,
                'vc_uid' => '00000000_vc_parking_permit',
                'transaction_id' => $application->vc_transaction_id,
            ]);

            return response()->json([
                'success' => true,
                'message' => '停車證領取成功',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '確認領取時發生錯誤',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
