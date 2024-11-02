<?php

namespace App\Services;

use App\Models\Location;
use App\Repositories\LocationRepository;

class LocationService
{
    private WeatherService $weatherService;

    public function __construct(private LocationRepository $locationRepository)
    {
        $this->weatherService = new WeatherService(app(OpenWeatherService::class));
    }   

    public function updateFiveDaysForecast(int $locationId)
    {
        $location = $this->locationRepository->findLocationById($locationId);

        $locationString = $location->name . ',' . $location->country;

        $locationForecastResponse = $this->weatherService->getWeather($locationString);

        foreach ($locationForecastResponse as $forecast) {
            $this->locationRepository->upsertLocationForecast($locationId, $forecast);
        }
    }
}
