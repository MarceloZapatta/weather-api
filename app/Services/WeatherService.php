<?php

namespace App\Services;

use App\Interfaces\WeatherServiceInterface;
use App\Models\LocationForecastResponse;

/**
 * This is a factory class that creates a new instance of the OpenWeatherService class.
 */
class WeatherService
{
    private WeatherServiceInterface $weatherProvider;

    public function __construct() {
        $this->weatherProvider = new OpenWeatherService();
    }

    /**
     * @param string $location
     * @return LocationForecastResponse[]
     */
    public function getWeather(string $location): array
    {
        return $this->weatherProvider->getWeatherForecast($location);
    }
}
