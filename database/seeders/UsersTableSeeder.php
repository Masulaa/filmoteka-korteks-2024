<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $specificUser = User::where('email', 'test@test.com')->first();

        if (!$specificUser) {
            // Create specific user
        }

        User::factory()->count(10)->create();
    }
}
