<?php

namespace App\Services;

use App\Interfaces\WeatherServiceInterface;
use App\Models\LocationForecastResponse;

class WeatherService
{
    public function __construct(private WeatherServiceInterface $weatherService) {}

    /**
     * @param string $location
     * @return LocationForecastResponse[]
     */
    public function getWeather(string $location): array
    {
        return $this->weatherService->getWeatherForecast($location);
    }
}
