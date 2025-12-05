<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VPVerificationLog extends Model
{
    protected $table = 'vp_verification_logs';

    protected $fillable = [
        'machine_id',
        'transaction_id',
        'vp_ref',
        'vp_name',
        'action',
        'verify_result',
        'result_description',
        'credential_data',
        'permit_id',
        'name',
        'parking_type',
        'verified_at',
    ];

    protected $casts = [
        'credential_data' => 'array',
        'verify_result' => 'boolean',
        'verified_at' => 'datetime',
    ];

    /**
     * 記錄取得配置
     */
    public static function logConfigRequest(string $machineId, string $transactionId, string $vpRef, string $vpName): void
    {
        self::create([
            'machine_id' => $machineId,
            'transaction_id' => $transactionId,
            'vp_ref' => $vpRef,
            'vp_name' => $vpName,
            'action' => 'config_requested',
        ]);
    }

    /**
     * 記錄掃描檢測
     */
    public static function logScanDetected(string $machineId, string $transactionId): void
    {
        self::create([
            'machine_id' => $machineId,
            'transaction_id' => $transactionId,
            'action' => 'scan_detected',
        ]);
    }

    /**
     * 記錄驗證成功
     */
    public static function logVerifySuccess(
        string $machineId,
        string $transactionId,
        string $vpRef,
        string $vpName,
        array $data
    ): void {
        self::create([
            'machine_id' => $machineId,
            'transaction_id' => $transactionId,
            'vp_ref' => $vpRef,
            'vp_name' => $vpName,
            'action' => 'verify_success',
            'verify_result' => true,
            'result_description' => '驗證成功',
            'credential_data' => $data,
            'permit_id' => $data['permit_id'] ?? null,
            'name' => $data['name'] ?? null,
            'parking_type' => $data['parking_type'] ?? null,
            'verified_at' => now(),
        ]);
    }

    /**
     * 記錄驗證失敗
     */
    public static function logVerifyFailed(
        string $machineId,
        string $transactionId,
        string $vpRef,
        string $vpName,
        string $reason
    ): void {
        self::create([
            'machine_id' => $machineId,
            'transaction_id' => $transactionId,
            'vp_ref' => $vpRef,
            'vp_name' => $vpName,
            'action' => 'verify_failed',
            'verify_result' => false,
            'result_description' => $reason,
            'verified_at' => now(),
        ]);
    }

    /**
     * 關聯到機器
     */
    public function machine()
    {
        return $this->belongsTo(VPMachine::class, 'machine_id', 'machine_id');
    }
}
