<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VCStatusChangeLog extends Model
{
    protected $table = 'vc_status_change_logs';

    protected $fillable = [
        'employee_id',
        'action',
        'reason',
        'old_vc_cid',
        'new_vc_cid',
        'vc_uid',
        'transaction_id',
        'response_data',
    ];

    protected $casts = [
        'response_data' => 'array',
    ];

    /**
     * 關聯到員工
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'employee_id');
    }
}
