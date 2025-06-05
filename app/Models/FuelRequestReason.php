<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FuelRequestReason extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'trip_id',
    ];
    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

}
