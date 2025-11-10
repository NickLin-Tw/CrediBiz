<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IssuedVC extends Model
{
    protected $table = 'issued_vcs';

    protected $fillable = [
        'employee_id',
        'vc_cid',
        'vc_uid',
        'transaction_id',
        'is_revoked',
        'revoked_at',
    ];

    protected $casts = [
        'is_revoked' => 'boolean',
        'revoked_at' => 'datetime',
    ];

    /**
     * 關聯到員工
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}
