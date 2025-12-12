<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmployeeLoginLog extends Model
{
    protected $fillable = [
        'employee_id',
        'vp_transaction_id',
        'ip_address',
        'user_agent',
    ];

    /**
     * 關聯到員工
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    /**
     * 關聯到 VP 驗證結果
     */
    public function vpVerificationResult(): BelongsTo
    {
        return $this->belongsTo(VPVerificationResult::class, 'vp_transaction_id', 'transaction_id');
    }
}
