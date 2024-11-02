<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocationForecast extends Model
{
    protected $fillable = [
        'location_id',
        'date',
        'icon',
        'main_description',
        'description',
        'temperature',
        'temperature_min',
        'temperature_max',
        'humidity',
        'rain',
        'wind_speed',
    ];
}
