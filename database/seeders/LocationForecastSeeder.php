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
                    'temperature' => rand(-20, 40),
                    'humidity' => rand(0, 100),
                    'rainfall' => rand(0, 100),
                    'wind_speed' => rand(0, 100),
                    'wind_direction' => rand(0, 360),
                    'pressure' => rand(900, 1100),
                    'visibility' => rand(0, 100),
                    'cloud_cover' => rand(0, 100)
                ]);
            }
        }
    }
}
