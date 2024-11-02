<?php

use App\Console\Commands\UpdateLocationForecasts;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command(UpdateLocationForecasts::class)
    ->everyThreeHours()
    ->appendOutputTo(storage_path('logs/update-location-forecast.log'));
