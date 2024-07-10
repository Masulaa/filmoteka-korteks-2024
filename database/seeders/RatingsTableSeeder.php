<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Seeder;

class RatingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::pluck('id')->toArray();
        $movies = Movie::pluck('id')->toArray();

        //This checks if rating already exists
        foreach ($movies as $movieId) {
            foreach ($users as $userId) {
                $existingRating = Rating::where('user_id', $userId)
                                        ->where('movie_id', $movieId)
                                        ->first();

                if (!$existingRating) {
                    Rating::factory()->create([
                        'user_id' => $userId,
                        'movie_id' => $movieId,
                        'rating' => rand(1, 10),
                    ]);
                }
            }
        }
    }
}
