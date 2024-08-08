<?php

namespace Database\Factories;

use App\Models\{Movie, User, MovieRating};
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieRatingFactory extends Factory
{
    protected $model = MovieRating::class;

    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'movie_id' => Movie::factory()->create()->id,
            'rating' => $this->faker->numberBetween(1, 100),
        ];
    }
}
