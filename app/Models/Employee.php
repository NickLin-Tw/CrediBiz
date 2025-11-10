<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

class Employee extends Model
{
    use HasApiTokens;
    protected $fillable = [
        'vp_transaction_id',
        'employee_id',
        'credential_token',
        'name',
        // 身分證相關（從 VP 複製而來，但可修改）
        'id_number',
        'roc_birthday',
        'registered_address',
        // 學歷相關（從 VP 複製而來，但可修改）
        'degree_name',
        'degree_level',
        'major',
        'graduation_date',
        'education_institution',
        // 多益相關（從 VP 複製而來，但可修改）
        'test_name',
        'test_date',
        'score_listening',
        'score_reading',
        'score_total',
        // 職位資訊
        'position',
        'department',
        'employment_start_date',
        'company_name',
        // 員工憑證
        'employee_vc_transaction_id',
        'employee_vc_cid',
        'employee_vc_issued_at',
        'employee_vc_expiry_date',
        'last_login_at',
    ];

    protected $casts = [
        'graduation_date' => 'date',
        'test_date' => 'date',
        'employment_start_date' => 'date',
        'employee_vc_issued_at' => 'datetime',
        'employee_vc_expiry_date' => 'date',
        'last_login_at' => 'datetime',
    ];

    /**
     * 產生下一個員工編號（6位流水號）
     */
    public static function generateEmployeeId(): string
    {
        $lastEmployee = self::orderBy('employee_id', 'desc')->first();

        if (!$lastEmployee) {
            return '000001';
        }

        $nextNumber = intval($lastEmployee->employee_id) + 1;
        return str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
    }

    /**
     * 產生員工證領取 token（用於驗證領取連結）
     */
    public static function generateCredentialToken(): string
    {
        return bin2hex(random_bytes(32)); // 64 字元的隨機 token
    }
}
