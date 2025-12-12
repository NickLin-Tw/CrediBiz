<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApiLog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminApiLogController extends Controller
{
    /**
     * 取得 API Logs 列表
     */
    public function index(Request $request): JsonResponse
    {
        $query = ApiLog::query();

        // 篩選：服務類型
        if ($service = $request->input('service')) {
            $query->where('service', $service);
        }

        // 篩選：HTTP 方法
        if ($method = $request->input('method')) {
            $query->where('method', $method);
        }

        // 篩選：成功/失敗
        if ($request->has('success')) {
            $query->where('success', $request->boolean('success'));
        }

        // 篩選：Transaction ID
        if ($transactionId = $request->input('transaction_id')) {
            $query->where('transaction_id', 'like', "%{$transactionId}%");
        }

        // 篩選：Endpoint
        if ($endpoint = $request->input('endpoint')) {
            $query->where('endpoint', 'like', "%{$endpoint}%");
        }

        // 篩選：日期範圍
        if ($startDate = $request->input('start_date')) {
            $query->whereDate('created_at', '>=', $startDate);
        }
        if ($endDate = $request->input('end_date')) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        // 排序
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        $query->orderBy($sortBy, $sortOrder);

        // 分頁
        $perPage = $request->input('per_page', 20);
        $logs = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'logs' => $logs,
        ]);
    }

    /**
     * 取得單一 API Log 詳情
     */
    public function show(int $id): JsonResponse
    {
        $log = ApiLog::find($id);

        if (!$log) {
            return response()->json([
                'success' => false,
                'message' => '找不到 API Log',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'log' => $log,
        ]);
    }

    /**
     * 取得統計資料
     */
    public function statistics(Request $request): JsonResponse
    {
        $startDate = $request->input('start_date', now()->subWeek()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));

        $query = ApiLog::whereBetween('created_at', [$startDate, $endDate]);

        $stats = [
            'total' => $query->count(),
            'success' => (clone $query)->where('success', true)->count(),
            'failed' => (clone $query)->where('success', false)->count(),
            'issuer_calls' => (clone $query)->where('service', 'issuer')->count(),
            'verifier_calls' => (clone $query)->where('service', 'verifier')->count(),
            'avg_duration_ms' => (clone $query)->avg('duration_ms'),
            'max_duration_ms' => (clone $query)->max('duration_ms'),
        ];

        // 依服務統計
        $byService = ApiLog::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('service, COUNT(*) as count, AVG(duration_ms) as avg_duration')
            ->groupBy('service')
            ->get();

        // 依 HTTP 方法統計
        $byMethod = ApiLog::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('method, COUNT(*) as count')
            ->groupBy('method')
            ->get();

        // 依 Endpoint 統計 (Top 10)
        $byEndpoint = ApiLog::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('endpoint, COUNT(*) as count, AVG(duration_ms) as avg_duration')
            ->groupBy('endpoint')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'statistics' => $stats,
            'by_service' => $byService,
            'by_method' => $byMethod,
            'by_endpoint' => $byEndpoint,
            'date_range' => [
                'start_date' => $startDate,
                'end_date' => $endDate,
            ],
        ]);
    }

    /**
     * 清理舊的 API Logs
     */
    public function cleanup(Request $request): JsonResponse
    {
        $days = $request->input('days', 30);

        $deletedCount = ApiLog::where('created_at', '<', now()->subDays($days))->delete();

        return response()->json([
            'success' => true,
            'message' => "已刪除 {$deletedCount} 筆超過 {$days} 天的 API Logs",
            'deleted_count' => $deletedCount,
        ]);
    }
}
