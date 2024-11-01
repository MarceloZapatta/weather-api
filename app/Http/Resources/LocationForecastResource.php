<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LocationForecastResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'date' => $this->date,
            'temperature' => $this->temperature,
            'humidity' => $this->humidity,
            'rainfall' => $this->rainfall,
            'wind_speed' => $this->wind_speed,
            'wind_direction' => $this->wind_direction,
            'pressure' => $this->pressure,
            'visibility' => $this->visibility,
            'cloud_cover' => $this->cloud_cover
        ];
    }
}
