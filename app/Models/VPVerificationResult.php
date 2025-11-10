<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VPVerificationResult extends Model
{
    protected $table = 'vp_verification_results';

    protected $fillable = [
        'transaction_id',
        'verify_result',
        'result_description',
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
}
