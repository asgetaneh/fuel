<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Office extends Model
{
   use HasFactory;

    protected $fillable = [
        'name', 'parent_office_id', 'manager_id', 'description'
    ];

    public function parentOffice() {
        return $this->belongsTo(Office::class, 'parent_office_id');
    }

    public function children() {
        return $this->hasMany(Office::class, 'parent_office_id');
    }

    public function manager() {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
