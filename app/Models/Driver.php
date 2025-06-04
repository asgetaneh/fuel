<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = [
        'name',
        'office_id',
        'license_number',
        'phone',
        'description',
    ];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
