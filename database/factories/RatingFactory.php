<?php

namespace Database\Factories;

use App\Models\Rating;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    protected $model = Rating::class;

    public function definition()
    {
        return [
            'user_id' => 1,
            'movie_id' => rand(1, 20), 
            'rating' => rand(1, 10),
        ];
    }
}
