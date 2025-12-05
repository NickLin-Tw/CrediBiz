<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VPVerificationResult extends Model
{
    protected $table = 'vp_verification_results';

    protected $fillable = [
        'transaction_id',
        'employee_id',
        'vp_type',
        'verify_result',
        'result_description',
        'rejection_reason',
        'credentials',
        'full_response',
        'is_used',
        'verified_at',
    ];

    protected $casts = [
        'verify_result' => 'boolean',
        'credentials' => 'array',
        'full_response' => 'array',
        'is_used' => 'boolean',
        'verified_at' => 'datetime',
    ];

    /**
     * 關聯到員工
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }

    /**
     * 關聯到病假申請
     */
    public function medicalLeaves(): HasMany
    {
        return $this->hasMany(MedicalLeave::class, 'vp_transaction_id', 'transaction_id');
    }
}
