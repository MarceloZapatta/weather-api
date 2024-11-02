<?php

namespace App\Services;

use App\Interfaces\WeatherServiceInterface;

class WeatherService
{
    public function __construct(private WeatherServiceInterface $weatherService) {}

    /**
     * @param string $location
     * @return LocationForecastResponse[]
     */
    public function getWeather(string $location)
    {
        return $this->weatherService->getWeatherForecast($location);
    }
}
