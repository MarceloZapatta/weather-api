# Weather API Project ⛅

## How to run
- Is using laravel Sail
- Copy .env.example .env
- This project is using OpenWeatherAPI, so insert your key at the .env key `OPEN_WEATHER_API_KEY=`
- ./vendor/bin/sail up -d
- ./vendor/bin/sail migrate --seed
    - This will migrate and run the seeds with two `Test Users`
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
    - Used to insert into queue the Location update notification
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