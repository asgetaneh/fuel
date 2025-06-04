<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class FuelPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'price_in_ETB',
        'fuel_id',
        'date',
        'is_active',
    ];
    public function fuel()
    {
        return $this->belongsTo(Fuel::class);
    }

}
