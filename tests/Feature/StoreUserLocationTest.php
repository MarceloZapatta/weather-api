<?php

namespace Tests\Feature;

use App\Models\Location;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class SaveLocationTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_should_not_found_city_weather_data(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user, ['*']);

        Http::shouldReceive('get')
            ->once()
            ->andReturnSelf();

        Http::shouldReceive('getStatusCode')
            ->andReturn(404);

        Http::shouldReceive('getBody')
            ->andReturn(json_encode([
                'cod' => '404',
                'message' => 'city not found',
            ]));


        $data = [
            'city' => 'Teste',
            'country' => 'ARA',
        ];

        $this->post('/api/user/locations', $data)
            ->assertStatus(400)
            ->assertJson([
                'message' => 'Unable to fetch weather data for this location.',
            ]);
    }

    public function test_it_should_create_a_new_location_for_user_with_forecast(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user, ['*']);

        $locationForecastResponseMock = [
            "cod" => "200",
            "message" => 0,
            "cnt" => 40,
            "list" => [
                [
                    "dt" => 1730581200,
                    "main" => [
                        "temp" => 17.92,
                        "feels_like" => 18.35,
                        "temp_min" => 17.92,
                        "temp_max" => 20.97,
                        "pressure" => 1014,
                        "sea_level" => 1014,
                        "grnd_level" => 917,
                        "humidity" => 99,
                        "temp_kf" => -3.05
                    ],
                    "weather" => [
                        [
                            "id" => 500,
                            "main" => "Rain",
                            "description" => "light rain",
                            "icon" => "10d"
                        ]
                    ],
                    "clouds" => [
                        "all" => 100
                    ],
                    "wind" => [
                        "speed" => 3.53,
                        "deg" => 147,
                        "gust" => 7.7
                    ],
                    "visibility" => 10000,
                    "pop" => 0.92,
                    "rain" => [
                        "3h" => 0.59
                    ],
                    "sys" => [
                        "pod" => "d"
                    ],
                    "dt_txt" => "2024-11-02 21:00:00"
                ],
                [
                    "dt" => 1730592000,
                    "main" => [
                        "temp" => 17.95,
                        "feels_like" => 18.33,
                        "temp_min" => 17.95,
                        "temp_max" => 18.01,
                        "pressure" => 1015,
                        "sea_level" => 1015,
                        "grnd_level" => 918,
                        "humidity" => 97,
                        "temp_kf" => -0.06
                    ],
                    "weather" => [
                        [
                            "id" => 500,
                            "main" => "Rain",
                            "description" => "light rain",
                            "icon" => "10n"
                        ]
                    ],
                    "clouds" => [
                        "all" => 100
                    ],
                    "wind" => [
                        "speed" => 1.92,
                        "deg" => 157,
                        "gust" => 4.13
                    ],
                    "visibility" => 7647,
                    "pop" => 1,
                    "rain" => [
                        "3h" => 1.28
                    ],
                    "sys" => [
                        "pod" => "n"
                    ],
                    "dt_txt" => "2024-11-03 00:00:00"
                ],
                [
                    "dt" => 1730602800,
                    "main" => [
                        "temp" => 17.87,
                        "feels_like" => 18.22,
                        "temp_min" => 17.85,
                        "temp_max" => 17.87,
                        "pressure" => 1015,
                        "sea_level" => 1015,
                        "grnd_level" => 918,
                        "humidity" => 96,
                        "temp_kf" => 0.02
                    ],
                    "weather" => [
                        [
                            "id" => 500,
                            "main" => "Rain",
                            "description" => "light rain",
                            "icon" => "10n"
                        ]
                    ],
                    "clouds" => [
                        "all" => 100
                    ],
                    "wind" => [
                        "speed" => 1.22,
                        "deg" => 176,
                        "gust" => 2.02
                    ],
                    "visibility" => 3051,
                    "pop" => 0.2,
                    "rain" => [
                        "3h" => 0.16
                    ],
                    "sys" => [
                        "pod" => "n"
                    ],
                    "dt_txt" => "2024-11-03 03:00:00"
                ],
                [
                    "dt" => 1730613600,
                    "main" => [
                        "temp" => 18.01,
                        "feels_like" => 18.32,
                        "temp_min" => 18.01,
                        "temp_max" => 18.01,
                        "pressure" => 1013,
                        "sea_level" => 1013,
                        "grnd_level" => 916,
                        "humidity" => 94,
                        "temp_kf" => 0
                    ],
                    "weather" => [
                        [
                            "id" => 500,
                            "main" => "Rain",
                            "description" => "light rain",
                            "icon" => "10n"
                        ]
                    ],
                    "clouds" => [
                        "all" => 100
                    ],
                    "wind" => [
                        "speed" => 1.68,
                        "deg" => 123,
                        "gust" => 3.99
                    ],
                    "visibility" => 10000,
                    "pop" => 0.25,
                    "rain" => [
                        "3h" => 0.1
                    ],
                    "sys" => [
                        "pod" => "n"
                    ],
                    "dt_txt" => "2024-11-03 06:00:00"
                ],
                [
                    "dt" => 1730624400,
                    "main" => [
                        "temp" => 18.24,
                        "feels_like" => 18.6,
                        "temp_min" => 18.24,
                        "temp_max" => 18.24,
                        "pressure" => 1014,
                        "sea_level" => 1014,
                        "grnd_level" => 917,
                        "humidity" => 95,
                        "temp_kf" => 0
                    ],
                    "weather" => [
                        [
                            "id" => 500,
                            "main" => "Rain",
                            "description" => "light rain",
                            "icon" => "10d"
                        ]
                    ],
                    "clouds" => [
                        "all" => 100
                    ],
                    "wind" => [
                        "speed" => 1.32,
                        "deg" => 67,
                        "gust" => 3.84
                    ],
                    "visibility" => 10000,
                    "pop" => 1,
                    "rain" => [
                        "3h" => 0.62
                    ],
                    "sys" => [
                        "pod" => "d"
                    ],
                    "dt_txt" => "2024-11-03 09:00:00"
                ]
            ],
            "city" => [
                "id" => 6322204,
                "name" => "London",
                "coord" => [
                    "lat" => -23.6704,
                    "lon" => -46.9472
                ],
                "country" => "UK",
                "population" => 201023,
                "timezone" => -10800,
                "sunrise" => 1730535641,
                "sunset" => 1730582515
            ]
        ];

        Http::shouldReceive('get')
            ->once()
            ->andReturnSelf();

        Http::shouldReceive('getStatusCode')
            ->andReturn(200);

        Http::shouldReceive('getBody')
            ->andReturn(json_encode($locationForecastResponseMock));

        $data = [
            'city' => 'London',
            'country' => 'UK',
        ];

        $response = $this->post('/api/user/locations', $data);

        $response->assertStatus(201);

        $location = Location::where('city', 'London')->where('country', 'UK')->first();

        $this->assertNotEmpty($location);

        $this
            ->assertDatabaseHas('location_users', [
                'user_id' => User::first()->id,
                'location_id' => $location->id,
            ])
            ->assertDatabaseHas('location_forecasts', [
                'location_id' => $location->id,
                'date' => '2024-11-02 21:00:00',
                'icon' => '10d',
                'main_description' => 'Rain',
                'description' => 'light rain',
                'temperature' => 17.92,
                'temperature_min' => 17.92,
                'temperature_max' => 20.97,
                'humidity' => 99,
                'rain' => 0.59,
                'wind_speed' => 3.53,
            ])
            ->assertDatabaseCount('location_forecasts', 5);

        $response = $this->post('/api/user/locations', $data);

        $response->assertStatus(400);
        $response->assertJson([
            'message' => 'User location already exists',
        ]);
    }
}
