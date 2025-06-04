<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehiclePerformance extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id',
        'average_distance_km_per_hr',
        'average_km_per_litter',
        'speed_per_km_hr',
        'description',
        'date',
        'recorded_by',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function recorder()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
