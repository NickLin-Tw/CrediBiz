<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Request;

class ActivityLog extends Model
{
    protected $fillable = [
        'employee_id',
        'actor_id',
        'actor_type',
        'actor_name',
        'action',
        'action_display',
        'description',
        'target_type',
        'target_id',
        'status',
        'reason',
        'metadata',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * 關聯：相關員工
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    /**
     * 關聯：操作者（如果是員工）
     */
    public function actor(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'actor_id', 'employee_id');
    }

    /**
     * 靜態方法：記錄活動
     */
    public static function log(array $data): self
    {
        // 自動填充 IP 和 User Agent
        if (!isset($data['ip_address'])) {
            $data['ip_address'] = Request::ip();
        }
        if (!isset($data['user_agent'])) {
            $data['user_agent'] = Request::userAgent();
        }

        return self::create($data);
    }

    /**
     * 靜態方法：記錄 VC 發行
     */
    public static function logVCIssue(
        string $employeeId,
        string $vcCid,
        string $vcUid,
        string $reason,
        ?string $actorId = null,
        string $actorType = 'employee'
    ): self {
        return self::log([
            'employee_id' => $employeeId,
            'actor_id' => $actorId ?? $employeeId,
            'actor_type' => $actorType,
            'action' => 'issue_vc',
            'action_display' => '發行憑證',
            'description' => $reason,
            'target_type' => 'vc',
            'target_id' => $vcCid,
            'status' => 'success',
            'metadata' => [
                'vc_uid' => $vcUid,
                'vc_cid' => $vcCid,
            ],
        ]);
    }

    /**
     * 靜態方法：記錄 VP 驗證
     */
    public static function logVPVerification(
        string $transactionId,
        string $reason,
        bool $success = true,
        ?string $employeeId = null,
        ?string $failureReason = null,
        array $metadata = []
    ): self {
        return self::log([
            'employee_id' => $employeeId,
            'actor_id' => $employeeId,
            'actor_type' => $employeeId ? 'employee' : 'system',
            'action' => 'verify_vp',
            'action_display' => '驗證 VP',
            'description' => $reason,
            'target_type' => 'vp',
            'target_id' => $transactionId,
            'status' => $success ? 'success' : 'failed',
            'reason' => $failureReason,
            'metadata' => $metadata,
        ]);
    }

    /**
     * 靜態方法：記錄 VC 撤銷
     */
    public static function logVCRevoke(
        string $employeeId,
        string $vcCid,
        string $reason,
        string $actorId,
        string $actorType = 'admin'
    ): self {
        return self::log([
            'employee_id' => $employeeId,
            'actor_id' => $actorId,
            'actor_type' => $actorType,
            'action' => 'revoke_vc',
            'action_display' => '撤銷憑證',
            'description' => $reason,
            'target_type' => 'vc',
            'target_id' => $vcCid,
            'status' => 'success',
        ]);
    }
}
