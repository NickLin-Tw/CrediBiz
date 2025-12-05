<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiLog extends Model
{
    protected $fillable = [
        'service',
        'method',
        'endpoint',
        'full_url',
        'request_headers',
        'request_body',
        'response_status',
        'response_headers',
        'response_body',
        'duration_ms',
        'success',
        'error_message',
        'transaction_id',
        'employee_id',
        'triggered_by',
    ];

    protected $casts = [
        'request_headers' => 'array',
        'request_body' => 'array',
        'response_headers' => 'array',
        'response_body' => 'array',
        'success' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * 靜態方法：記錄 API 呼叫
     */
    public static function logApiCall(array $data): self
    {
        return self::create($data);
    }
}
