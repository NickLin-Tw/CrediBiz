<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\EmployeeCredentialController;
use App\Http\Controllers\AuthController;
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
    Route::get('/login-logs', [App\Http\Controllers\Admin\AdminDashboardController::class, 'getLoginLogs']);
    Route::get('/vc-issued-logs', [App\Http\Controllers\Admin\AdminDashboardController::class, 'getVCIssuedLogs']);
    Route::get('/vp-verification-logs', [App\Http\Controllers\Admin\AdminDashboardController::class, 'getVPVerificationLogs']);
    Route::get('/vc-status-change-logs', [App\Http\Controllers\Admin\AdminDashboardController::class, 'getVCStatusChangeLogs']);
    Route::get('/employees', [App\Http\Controllers\Admin\AdminDashboardController::class, 'getEmployees']);
    Route::post('/employees/{employee_id}/revoke', [App\Http\Controllers\Admin\AdminDashboardController::class, 'revokeCredential']);
    Route::post('/employees/{employee_id}/reissue', [App\Http\Controllers\Admin\AdminDashboardController::class, 'reissueCredential']);
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
