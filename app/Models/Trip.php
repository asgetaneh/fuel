<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trip extends Model
{
    protected $fillable = [
        'description',
        'from',
        'to',
        'vehicle_id',
        'start_time',
        'end_time',
        'driver_id'
    ];
    protected $casts = [
    'start_time' => 'datetime',
    'end_time' => 'datetime',
];

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }
}
