<?php

namespace Database\Seeders;

use App\Models\Location;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class LocationForecastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = Location::all();

        foreach ($locations as $location) {
            $now = Carbon::now();

            for ($i=0; $i < 5; $i++) { 
                $location->forecasts()->create([
                    'date' => $now->addDays($i),
                    'main_description' => 'Clear',
                    'description' => 'clear sky',
                    'temperature' => rand(0, 40),
                    'temperature_min' => rand(0, 25),
                    'temperature_max' => rand(25, 40),
                    'humidity' => rand(0, 100),
                    'rain' => rand(0, 100),
                    'wind_speed' => rand(0, 30),
                ]);
            }
        }
    }
}
