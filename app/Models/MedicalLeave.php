<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicalLeave extends Model
{
    protected $fillable = [
        'employee_id',
        'vp_transaction_id',
        'rest_start_date',
        'rest_end_date',
        'leave_start_date',
        'leave_end_date',
        'leave_days',
        'hospital_name',
        'doctor_name',
        'doctor_recommendation',
        'status',
        'reviewed_by',
        'reviewed_at',
        'review_note',
    ];

    protected $casts = [
        'rest_start_date' => 'date',
        'rest_end_date' => 'date',
        'leave_start_date' => 'date',
        'leave_end_date' => 'date',
        'reviewed_at' => 'datetime',
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
    public function vpVerification(): BelongsTo
    {
        return $this->belongsTo(VPVerificationResult::class, 'vp_transaction_id', 'transaction_id');
    }
}
