<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'name',
        'vehicle_type_id',
        'registration_number',
        'engine_number',
        'total_seat',
        'description',
        'driver_id',
        'is_active',
    ];

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
