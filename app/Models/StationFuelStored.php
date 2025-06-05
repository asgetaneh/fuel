<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StationFuelStored extends Model
{
   use HasFactory;

    protected $fillable = [
        'station_id',
        'fuel_id',
        'amount',
        'date',
        'received_by',
        'notes',
    ];
    protected $dates = ['date'];

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function fuel()
    {
        return $this->belongsTo(Fuel::class);
    }
}
