<?php

namespace App\Repositories;

use App\Models\Location;
use App\Models\LocationForecastResponse;

class LocationRepository
{
	public function __construct(private Location $model) {}

	public function findLocationById($id)
	{
		return $this->model->find($id);
	}

	function findLocationByCountryName(string $country, string $city): ?Location
	{
		return $this->model->where('country', $country)->where('city', $city)->first();
	}

	function createLocation(string $country, string $city): Location
	{
		return $this->model->updateOrCreate([
			'country' => $country,
			'city' => $city,
		]);
	}

	public function upsertLocationForecast(Location $location, LocationForecastResponse $forecast)
	{
		$location->forecasts()->updateOrCreate([
			'location_id' => $location->id,
			'date' => $forecast->date->format('Y-m-d H:i:s'),
		], [
			'location_id' => $location->id,
			'main_description' => $forecast->main_description,
			'description' => $forecast->description,
			'temperature' => $forecast->temperature,
			'temperature_min' => $forecast->temperature_min,
			'temperature_max' => $forecast->temperature_max,
			'humidity' => $forecast->humidity,
			'rain' => $forecast->rain,
			'wind_speed' => $forecast->wind_speed,
		]);
	}
}
