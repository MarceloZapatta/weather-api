<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::get(); 

        $locations = Location::limit(3)->get();

        foreach ($locations as $location) {
            foreach ($users as $user) {
                $user->locations()->attach($location->id);
            }
        }
    }
}
