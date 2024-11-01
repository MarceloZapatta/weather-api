<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Jorge Aragao',
                'email' => 'jorge@email.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Francisco de Assis',
                'email' => 'francisco@email.com',
                'password' => bcrypt('password'),
            ]
        ];
        
        User::insert($users);
    }
}
