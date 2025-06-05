<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuelDistributes extends Model
{
    protected $fillable = [
        'fuel_request_id',
        'vehicle_id',
        'total_km_covered_by_vehicle',
        'fuel_id',
        'amount',
        'date',
        'station_id',
        'service_reason_id',
        'requested_by',
        'approved_by',
        'provider_user_id',
        'notes',
    ];

    public function fuelRequest()
    {
        return $this->belongsTo(FuelRequest::class);
    }

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
        return $this->belongsTo(ServiceReason::class);
    }

    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_user_id');
    }
}
