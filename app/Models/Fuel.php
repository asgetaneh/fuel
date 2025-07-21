<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fuel extends Model
{
    protected $fillable = ['name','slug', 'description', 'measurement_id'];

    public function measurement()
    {
        return $this->belongsTo(Measurement::class);
    }
}
