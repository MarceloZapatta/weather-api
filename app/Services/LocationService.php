<?php

namespace App\Services;

use App\Exceptions\ErrorFetchingWeatherDataException;
use App\Exceptions\UnableToFetchWeatherNewLocationException;
use App\Models\Location;
use App\Repositories\LocationRepository;

class LocationService
{
    private WeatherService $weatherService;

    public function __construct(private LocationRepository $locationRepository)
    {
        $this->weatherService = new WeatherService(app(OpenWeatherService::class));
    }

    function createLocation(string $country, string $city): Location
    {
        $location = $this->locationRepository->createLocation($country, $city);

        try {
            $this->updateFiveDaysForecast($location);
        } catch (ErrorFetchingWeatherDataException $th) {
            $location->delete();
            throw new UnableToFetchWeatherNewLocationException;
        }

        return $location;
    }

    function findLocationByCountryName(string $country, string $name): ?Location
    {
        return $this->locationRepository->findLocationByCountryName($country, $name);
    }

    public function updateFiveDaysForecast(Location $location)
    {
        $locationString = $location->city . ',' . $location->country;

        $locationForecastResponse = $this->weatherService->getWeather($locationString);

        foreach ($locationForecastResponse as $forecast) {
            $this->locationRepository->upsertLocationForecast($location, $forecast);
        }
    }
}
