<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $email
 * @property string $name
 * @property string $application_reason
 * @property string $vehicle_plate_number
 * @property string $vehicle_type
 * @property string $brand_model
 * @property string $color
 * @property \Carbon\Carbon $parking_start_date
 * @property \Carbon\Carbon $parking_end_date
 * @property string $status
 * @property string|null $reviewed_by
 * @property \Carbon\Carbon|null $reviewed_at
 * @property string|null $review_note
 * @property string|null $permit_id
 * @property string $visitor_token
 * @property string|null $vc_transaction_id
 * @property string|null $vc_cid
 * @property string|null $qr_code
 * @property string|null $deep_link
 * @property bool $is_issued
 * @property \Carbon\Carbon|null $issued_at
 * @property-read Employee|null $reviewer
 * @property-read string $status_text
 * @property-read string $claim_url
 */
class VisitorParkingApplication extends Model
{
    protected $fillable = [
        'email',
        'name',
        'application_reason',
        'vehicle_plate_number',
        'vehicle_type',
        'brand_model',
        'color',
        'parking_start_date',
        'parking_end_date',
        'status',
        'reviewed_by',
        'reviewed_at',
        'review_note',
        'permit_id',
        'visitor_token',
        'vc_transaction_id',
        'vc_cid',
        'qr_code',
        'deep_link',
        'is_issued',
        'issued_at',
    ];

    protected $casts = [
        'parking_start_date' => 'date',
        'parking_end_date' => 'date',
        'reviewed_at' => 'datetime',
        'is_issued' => 'boolean',
        'issued_at' => 'datetime',
    ];

    /**
     * 產生唯一的訪客 token
     */
    public static function generateVisitorToken(): string
    {
        return bin2hex(random_bytes(32)); // 64 字元的隨機 token
    }

    /**
     * 產生訪客停車證編號 (格式: V + 年份後2碼 + 6位流水號)
     * 例如: V25000001
     */
    public static function generatePermitId(): string
    {
        $year = date('y'); // 年份後2碼
        $prefix = "V{$year}";

        // 取得今年最後一個訪客停車證編號
        $lastPermit = self::where('permit_id', 'like', "{$prefix}%")
            ->orderBy('permit_id', 'desc')
            ->first();

        if (!$lastPermit) {
            return $prefix . '000001';
        }

        // 提取流水號並加1
        $lastNumber = intval(substr($lastPermit->permit_id, 3));
        $nextNumber = $lastNumber + 1;

        return $prefix . str_pad((string) $nextNumber, 6, '0', STR_PAD_LEFT);
    }

    /**
     * 關聯到審核者
     */
    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'reviewed_by', 'employee_id');
    }

    /**
     * 取得申請狀態的中文描述
     */
    public function getStatusTextAttribute(): string
    {
        return match ($this->status) {
            'pending' => '待審核',
            'approved' => '已核准',
            default => '已拒絕',
        };
    }

    /**
     * 取得領取連結
     */
    public function getClaimUrlAttribute(): string
    {
        return url("/visitor-parking/{$this->visitor_token}");
    }
}
