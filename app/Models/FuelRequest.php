<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Vehicle;
use App\Models\Fuel;
use App\Models\Station;
use App\Models\FuelRequestReason;
use App\Models\User;
use App\Models\FuelDistribute;

class FuelRequest extends Model
{
   protected $fillable = [
        'vehicle_id',
        'total_km_covered_by_vehicle',
        'fuel_id',
        'amount',
        'date',
        'station_id',
        'service_reason_id',
        'requested_by',
        'approved_by',
        'notes',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function fuel()
    {
        return $this->belongsTo(Fuel::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function serviceReason()
    {
        return $this->belongsTo(FuelRequestReason::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function fuelDistributions()
    {
        return $this->hasMany(FuelDistribute::class);
    }
}
