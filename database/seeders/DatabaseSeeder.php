<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Movie;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            MoviesTableSeeder::class,
            RatingsTableSeeder::class,
        ]);
    }
}
