<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\EmployeeCredentialController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MedicalLeaveController;
use App\Http\Controllers\ParkingPermitController;
use App\Http\Controllers\VisitorParkingController;
use App\Http\Controllers\Admin\AdminEmployeeController;
use App\Http\Controllers\Admin\AdminMedicalLeaveController;
use App\Http\Controllers\Admin\AdminApiLogController;
use App\Http\Controllers\Admin\AdminVisitorParkingController;
use App\Services\TWDIWIssuerService;
use App\Services\TWDIWVerifierService;

Route::get('/user', function (Request $request) {
    $employee = $request->user();

    if (!$employee) {
        return response()->json(['message' => 'Unauthenticated'], 401);
    }

    return response()->json([
        'employee_id' => $employee->employee_id,
        'name' => $employee->name,
        'department' => $employee->department,
        'position' => $employee->position,
        'company_name' => $employee->company_name,
        'last_login_at' => $employee->last_login_at?->toIso8601String(),
        'employee_vc_expiry_date' => $employee->employee_vc_expiry_date?->format('Y-m-d'),
    ]);
})->middleware('auth:sanctum');

// 應徵申請
Route::post('/applications', [ApplicationController::class, 'store']);

// 員工憑證
Route::get('/employees/{employeeId}', [EmployeeCredentialController::class, 'show']);
Route::post('/employee-credentials/issue', [EmployeeCredentialController::class, 'issue']);
Route::put('/employees/{employeeId}/credential', [EmployeeCredentialController::class, 'updateCredential']);
Route::post('/employee-credentials/reissue', [EmployeeCredentialController::class, 'reissue'])->middleware('auth:sanctum');
Route::post('/employee-credentials/confirm-reissue', [EmployeeCredentialController::class, 'confirmReissue'])->middleware('auth:sanctum');

// 驗證與登入
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// 管理後台 API
Route::prefix('admin')->group(function () {
    // Dashboard 資料
    Route::get('/login-logs', [App\Http\Controllers\Admin\AdminDashboardController::class, 'getLoginLogs']);
    Route::get('/vc-issued-logs', [App\Http\Controllers\Admin\AdminDashboardController::class, 'getVCIssuedLogs']);
    Route::get('/vp-verification-logs', [App\Http\Controllers\Admin\AdminDashboardController::class, 'getVPVerificationLogs']);
    Route::get('/vc-status-change-logs', [App\Http\Controllers\Admin\AdminDashboardController::class, 'getVCStatusChangeLogs']);
    Route::get('/medical-leave-vp-logs', [App\Http\Controllers\Admin\AdminDashboardController::class, 'getMedicalLeaveVPLogs']);
    Route::get('/activity-logs', [App\Http\Controllers\Admin\AdminDashboardController::class, 'getActivityLogs']);
    Route::get('/activity-stats', [App\Http\Controllers\Admin\AdminDashboardController::class, 'getActivityStats']);

    // 員工管理（新）
    Route::prefix('employees')->group(function () {
        Route::get('/', [AdminEmployeeController::class, 'index']);
        Route::get('/{employeeId}', [AdminEmployeeController::class, 'show']);
        Route::put('/{employeeId}', [AdminEmployeeController::class, 'update']);
        Route::post('/revoke-vc', [AdminEmployeeController::class, 'revokeVC']);
        Route::post('/reissue-vc', [AdminEmployeeController::class, 'reissueVC']);
        Route::post('/resign', [AdminEmployeeController::class, 'resign']);
    });

    // 病假審核（新）
    Route::prefix('medical-leaves')->group(function () {
        Route::get('/', [AdminMedicalLeaveController::class, 'index']);
        Route::get('/statistics', [AdminMedicalLeaveController::class, 'statistics']);
        Route::get('/{id}', [AdminMedicalLeaveController::class, 'show']);
        Route::post('/{id}/approve', [AdminMedicalLeaveController::class, 'approve']);
        Route::post('/{id}/reject', [AdminMedicalLeaveController::class, 'reject']);
    });

    // API Logs（新）
    Route::prefix('api-logs')->group(function () {
        Route::get('/', [AdminApiLogController::class, 'index']);
        Route::get('/statistics', [AdminApiLogController::class, 'statistics']);
        Route::get('/{id}', [AdminApiLogController::class, 'show']);
        Route::post('/cleanup', [AdminApiLogController::class, 'cleanup']);
    });

    // 舊路由（保留相容性，考慮之後移除）
    Route::get('/employees-old', [App\Http\Controllers\Admin\AdminDashboardController::class, 'getEmployees']);
    Route::post('/employees/{employee_id}/revoke', [App\Http\Controllers\Admin\AdminDashboardController::class, 'revokeCredential']);
    Route::post('/employees/{employee_id}/reissue', [App\Http\Controllers\Admin\AdminDashboardController::class, 'reissueCredential']);
    Route::get('/medical-leaves-old', [App\Http\Controllers\Admin\AdminDashboardController::class, 'getMedicalLeaves']);
});

// TW-DIW 測試 API
Route::prefix('test')->group(function () {
    // VC 發行
    Route::post('/vc/issue', function (Request $request, TWDIWIssuerService $issuerService) {
        $validated = $request->validate([
            'vcUid' => 'required|string',
            'fields' => 'required|array',
            'issuanceDate' => 'nullable|string|date_format:Ymd',
            'expiredDate' => 'nullable|string|date_format:Ymd',
        ]);

        try {
            $result = $issuerService->issueVC(
                vcUid: $validated['vcUid'],
                fields: $validated['fields'],
                issuanceDate: $validated['issuanceDate'] ?? null,
                expiredDate: $validated['expiredDate'] ?? null
            );

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'message' => '發行失敗',
                'error' => $e->getMessage(),
            ], 500);
        }
    });

    // VC 狀態查詢
    Route::get('/vc/status/{transactionId}', function (string $transactionId, TWDIWIssuerService $issuerService) {
        try {
            $result = $issuerService->getVCStatus($transactionId);

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'message' => '查詢失敗',
                'error' => $e->getMessage(),
            ], 500);
        }
    });

    // VP 產生驗證 QR Code
    Route::post('/vp/generate', function (Request $request, TWDIWVerifierService $verifierService) {
        $validated = $request->validate([
            'ref' => 'required|string',
            'transactionId' => 'required|string',
        ]);

        try {
            $result = $verifierService->generateVPQRCode(
                ref: $validated['ref'],
                transactionId: $validated['transactionId']
            );

            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'message' => '產生 QR Code 失敗',
                'error' => $e->getMessage(),
            ], 500);
        }
    });

    // VP 查詢驗證結果
    Route::post('/vp/result', function (Request $request, TWDIWVerifierService $verifierService) {
        $validated = $request->validate([
            'transactionId' => 'required|string',
        ]);

        try {
            // 先從資料庫查詢（如果已經有結果就不用再問 TW-DIW）
            $storedResult = $verifierService->getStoredVPResult($validated['transactionId']);

            if ($storedResult) {
                return response()->json($storedResult);
            }

            // 資料庫中沒有，去 TW-DIW 查詢
            $result = $verifierService->getVPResult($validated['transactionId']);

            // 如果還沒有驗證結果（用戶還沒完成驗證），回傳 verifyResult: null
            if ($result === null) {
                return response()->json([
                    'verifyResult' => null,
                    'resultDescription' => null,
                    'data' => null,
                ]);
            }

            // 有結果了（已自動保存到資料庫），回傳給前端
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'message' => '查詢失敗',
                'error' => $e->getMessage(),
            ], 500);
        }
    });
});

// 病假申請 API
Route::prefix('medical-leaves')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [MedicalLeaveController::class, 'index']);
    Route::post('/verify-certificate', [MedicalLeaveController::class, 'verifyMedicalCertificate']);
    Route::post('/', [MedicalLeaveController::class, 'store']);
});

// 機場特約商店 POS API
Route::prefix('airport-pos')->group(function () {
    // 計算員工折扣
    Route::post('/calculate-discount', function (Request $request, TWDIWVerifierService $verifierService) {
        $validated = $request->validate([
            'transactionId' => 'required|string',
        ]);

        try {
            // 從資料庫查詢 VP 驗證結果
            $vpResult = $verifierService->getStoredVPResult($validated['transactionId']);

            if (!$vpResult) {
                return response()->json([
                    'message' => '找不到驗證結果',
                ], 404);
            }

            if (!$vpResult['verifyResult']) {
                return response()->json([
                    'message' => '驗證失敗',
                ], 400);
            }

            // 解析 VP 資料
            $credentials = $vpResult['data'] ?? [];
            $companyName = '';
            $position = '';

            // 尋找員工身分憑證並解析 claims
            foreach ($credentials as $credential) {
                if (isset($credential['credentialType']) &&
                    $credential['credentialType'] === '00000000_vc_employee_credential') {

                    $claims = $credential['claims'] ?? [];

                    // 遍歷 claims 陣列，根據 ename 取出對應的 value
                    foreach ($claims as $claim) {
                        $ename = $claim['ename'] ?? '';
                        $value = $claim['value'] ?? '';

                        if ($ename === 'company_name') {
                            $companyName = $value;
                        } elseif ($ename === 'position') {
                            $position = $value;
                        }
                    }
                    break;
                }
            }

            if (empty($companyName) && empty($position)) {
                return response()->json([
                    'message' => '無法取得員工資料',
                ], 400);
            }

            // 計算折扣
            $discount = 0;
            $discountDescription = '';

            if ($companyName === '臺灣航空') {
                if ($position === '空服員') {
                    $discount = 15;
                    $discountDescription = '臺灣航空空服員專屬優惠';
                } elseif ($position === '地勤人員') {
                    $discount = 10;
                    $discountDescription = '臺灣航空地勤人員專屬優惠';
                }
            }

            return response()->json([
                'discount' => $discount,
                'discountDescription' => $discountDescription,
                'companyName' => $companyName,
                'position' => $position,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => '計算折扣失敗',
                'error' => $e->getMessage(),
            ], 500);
        }
    });
});

// 停車證申請 API
Route::prefix('parking-permits')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [App\Http\Controllers\ParkingPermitController::class, 'show']);
    Route::post('/generate-verification-qr', [App\Http\Controllers\ParkingPermitController::class, 'generateVerificationQR']);
    Route::post('/verify-employee-credential', [App\Http\Controllers\ParkingPermitController::class, 'verifyEmployeeCredential']);
    Route::post('/apply', [App\Http\Controllers\ParkingPermitController::class, 'apply']);
    Route::post('/confirm-issuance', [App\Http\Controllers\ParkingPermitController::class, 'confirmIssuance']);
    Route::put('/update-vehicles', [App\Http\Controllers\ParkingPermitController::class, 'updateVehicles']);
    Route::post('/reissue', [App\Http\Controllers\ParkingPermitController::class, 'reissue']);
});

// 訪客停車證申請 API（公開）
Route::prefix('visitor-parking')->group(function () {
    Route::post('/applications', [App\Http\Controllers\VisitorParkingController::class, 'store']);
    Route::get('/applications/{visitorToken}', [App\Http\Controllers\VisitorParkingController::class, 'show']);
    Route::post('/applications/{visitorToken}/claim', [App\Http\Controllers\VisitorParkingController::class, 'claim']);
});

// Admin - 訪客停車證審核 API
Route::prefix('admin/visitor-parking')->group(function () {
    Route::get('/applications', [App\Http\Controllers\Admin\AdminVisitorParkingController::class, 'index']);
    Route::get('/applications/statistics', [App\Http\Controllers\Admin\AdminVisitorParkingController::class, 'statistics']);
    Route::get('/applications/{id}', [App\Http\Controllers\Admin\AdminVisitorParkingController::class, 'show']);
    Route::post('/applications/{id}/approve', [App\Http\Controllers\Admin\AdminVisitorParkingController::class, 'approve']);
    Route::post('/applications/{id}/reject', [App\Http\Controllers\Admin\AdminVisitorParkingController::class, 'reject']);
});

// VP Machine API（NFC 驗證機器）
Route::prefix('vp-machine')->group(function () {
    Route::get('/{machineId}/config', [App\Http\Controllers\VPMachineController::class, 'getConfig']);
    Route::post('/verify-result', [App\Http\Controllers\VPMachineController::class, 'verifyResult']);
});
