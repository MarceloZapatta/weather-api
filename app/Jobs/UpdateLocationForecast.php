<?php

namespace App\Jobs;

use App\Models\Location;
use App\Services\LocationService;
use App\Services\WeatherService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateLocationForecast implements ShouldQueue
{
    use Queueable;

    private LocationService $locationService;

    /**
     * Create a new job instance.
     */
    public function __construct(private Location $location) {
        $this->locationService = app(LocationService::class);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->locationService->updateFiveDaysForecast($this->location);
    }
}
