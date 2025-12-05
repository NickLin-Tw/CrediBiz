<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $permit_id
 * @property string $employee_id
 * @property string|null $vc_cid
 * @property string|null $vp_transaction_id
 * @property string|null $vc_transaction_id
 * @property string $name
 * @property string $parking_type
 * @property \Carbon\Carbon|null $issued_at
 * @property \Carbon\Carbon|null $expiry_date
 * @property-read Collection<int, ParkingPermitVehicle> $vehicles
 * @property-read Employee|null $employee
 */
class ParkingPermit extends Model
{
    protected $fillable = [
        'employee_id',
        'permit_id',
        'vp_transaction_id',
        'vc_transaction_id',
        'vc_cid',
        'name',
        'parking_type',
        'issued_at',
        'expiry_date',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
        'expiry_date' => 'date',
    ];

    /**
     * 產生下一個停車證編號 (格式: P + 年份後2碼 + 6位流水號)
     * 例如: P25000001
     */
    public static function generatePermitId(): string
    {
        $year = date('y'); // 年份後2碼
        $prefix = "P{$year}";

        // 取得今年最後一個停車證編號
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
     * 關聯到員工
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    /**
     * 關聯到車輛資料
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(ParkingPermitVehicle::class);
    }
}
