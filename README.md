# Weather API Project ⛅

This is the backend Laravel project, if you are looking for the Frontend:

[Weather Front Project](https://github.com/MarceloZapatta/weather-front)

## Requirements

- PHP 8.3
- Composer 2
- Docker for using Laravel Sail

Or you could configure every service by your own

- PHP 8.3
- MySQL 8
- Node 20

## How to run - Laravel Sail
- The project is using laravel Sail
- Copy `.env.example` `.env`
- Run `composer install`
- This project is using OpenWeatherAPI, so insert your key at the `.env` key `OPEN_WEATHER_API_KEY=`
- `./vendor/bin/sail up -d`
- `./vendor/bin/sail artisan migrate --seed`
    - This will migrate and run the seeds with two `Test Users`
- Run `./vendor/bin/sail artisan key:generate` to generate a new key

## How to run - Standlone php
- If don't want to use Laravel Sail you can configure the project by your own
- Install the MySQL database
- `composer install`
- `php artisan migrate --seed`
- `php artisan key:generate`
- `php artisan serve`
- Change you front end server to your `API_URL + '/api'`: `http://localhost:8000/api`

## Throubleshooting

- Maybe you can get permission issues with some folders using Laravel Sail
- `sudo chmod -R 777 storage/logs`
- `sudo chmod -R 777 storage/framework/views`
- `sudo chmod -R 777 storage/framework/cache`
- `sudo chmod -R 777 storage/framework/testing`

## API Documentation

You can check the [API Document from Postman here](https://documenter.getpostman.com/view/13192503/2sAY4ye1X6)

## Features ✨
- Migrations
- Factories
- Seeders
- FormRequests
- Sanctum
- Resources
- Http Client
- Gate, Policies
- Jobs
    - Used to insert into queue the Location update forecast
- Commands
    - ./vendor/bin/saiil artisan location:update-forecasts # Will update all locations
- Schedule
    - Command scheduled to run every 3 hours to get updated forecasts for all locations
- Feature tests
    - For saving user location, this is when is made a fetch for the Third Party OpenWeatherMap API

## Design 🏗️
- Service Repository pattern
- Factory Pattern for thirdy party Weather provider

## Test Users 👱

Jorge Aragao
```
email: 'jorge@email.com'
password: 'password'
```

Francisco de Assis
```
email: 'francisco@email.com'
password: 'password'
```