<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationUser extends Model
{
    protected $fillable = ['location_id'];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
