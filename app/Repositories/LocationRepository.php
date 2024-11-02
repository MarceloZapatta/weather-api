<?php

namespace App\Repositories;

use App\Models\Location;
use App\Models\LocationForecastResponse;

class LocationRepository
{
	protected $model;

	public function __construct(Location $location)
	{
		$this->model = $location;
	}

	public function findLocationById($id)
	{
		return $this->model->find($id);
	}

	public function upsertLocationForecast($locationId, LocationForecastResponse $forecast) {
		$location = $this->findLocationById($locationId);

		$location->forecasts()->updateOrCreate([
			'location_id' => $locationId,
			'date' => $forecast->date->format('Y-m-d H:i:s'),
		], [
			'location_id' => $locationId,
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
