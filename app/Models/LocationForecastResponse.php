<?php

namespace App\Models;

use Carbon\Carbon;

class LocationForecastResponse
{
  public function __construct(
    public Carbon $date,
    public string $icon,
    public string $main_description,
    public string $description,
    public float $temperature,
    public float $temperature_min,
    public float $temperature_max,
    public int $humidity,
    public float $rain,
    public float $wind_speed
  ) {}
}
