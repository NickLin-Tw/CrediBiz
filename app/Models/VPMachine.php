<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VPMachine extends Model
{
    protected $table = 'vp_machines';

    protected $fillable = [
        'machine_id',
        'name',
        'vp_ref',
        'vp_name',
        'location',
        'status',
        'last_seen_at',
    ];

    protected $casts = [
        'last_seen_at' => 'datetime',
    ];

    /**
     * 根據 machine_id 取得機器配置
     */
    public static function getConfigByMachineId(string $machineId): ?array
    {
        $machine = self::where('machine_id', $machineId)
            ->where('status', 'active')
            ->first();

        if (!$machine) {
            return null;
        }

        // 更新最後連線時間
        $machine->update(['last_seen_at' => now()]);

        return [
            'vp_ref' => $machine->vp_ref,
            'vp_name' => $machine->vp_name,
            'machine_name' => $machine->name,
            'location' => $machine->location,
        ];
    }

    /**
     * 檢查機器是否存在且啟用
     */
    public static function isActive(string $machineId): bool
    {
        return self::where('machine_id', $machineId)
            ->where('status', 'active')
            ->exists();
    }
}
