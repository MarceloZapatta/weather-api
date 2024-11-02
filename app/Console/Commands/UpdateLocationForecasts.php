<?php

namespace App\Console\Commands;

use App\Jobs\UpdateLocationForecast;
use App\Models\Location;
use Illuminate\Console\Command;

class UpdateLocationForecasts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'location:update-forecasts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all locatioons forecasts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Dispatching updated to all locations forecasts');

        $locations = Location::all();

        $this->output->progressStart($locations->count());

        foreach ($locations as $location) {
            UpdateLocationForecast::dispatch($location);
        }

        $this->output->progressFinish();
    }
}
