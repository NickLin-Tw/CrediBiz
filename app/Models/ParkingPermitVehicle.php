<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkingPermitVehicle extends Model
{
    protected $fillable = [
        'parking_permit_id',
        'vehicle_plate_number',
        'vehicle_type',
        'brand_model',
        'color',
    ];

    /**
     * 關聯到停車證
     */
    public function parkingPermit()
    {
        return $this->belongsTo(ParkingPermit::class);
    }
}
