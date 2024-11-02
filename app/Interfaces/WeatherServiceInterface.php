<?php

namespace App\Interfaces;

interface WeatherServiceInterface
{
  /**
   * @param string $location
   * @return LocationForecastResponse[]
   */
  public function getWeatherForecast(string $location): array;
}
