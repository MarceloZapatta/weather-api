<?php

namespace App\Services;

use App\Exceptions\ErrorFetchingWeatherDataException;
use App\Exceptions\OpenWeatherAPIKeyNotSetException;
use App\Interfaces\OpenWeatherApiResponseInterface;
use App\Interfaces\WeatherServiceInterface;
use App\Models\LocationForecastResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class OpenWeatherService implements WeatherServiceInterface
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = env('OPEN_WEATHER_API_KEY');

        if (!$this->apiKey) {
            throw new OpenWeatherAPIKeyNotSetException;
        }
    }

    /**
     * @param string $location
     * @return LocationForecastResponse[]
     * @throws ErrorFetchingWeatherDataException
     */
    public function getWeatherForecast(string $location): array
    {
        $response = Http::get("https://api.openweathermap.org/data/2.5/forecast?q={$location}&appid={$this->apiKey}&units=metric");

        if ($response->getStatusCode() !== 200) {
            throw new ErrorFetchingWeatherDataException;
        }

        return $this->handleWeatherForecastResponse(json_decode($response->getBody()));
    }

    /**
     * @param OpenWeatherApiResponseInterface $response
     * @return LocationForecastResponse[]
     */
    private function handleWeatherForecastResponse(object $response): array
    {
        $list = $response->list;

        $locationForecasts = [];

        foreach ($list as $item) {
            $locationForecasts[] = new LocationForecastResponse(
                Carbon::parse($item->dt),
                $item->weather[0]->icon,
                $item->weather[0]->main,
                $item->weather[0]->description,
                $item->main->temp,
                $item->main->temp_min,
                $item->main->temp_max,
                $item->main->humidity,
                $item->rain->{'3h'} ?? 0,
                $item->wind->speed
            );
        }

        return $locationForecasts;
    }
}
