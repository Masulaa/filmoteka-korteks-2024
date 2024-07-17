<?php

namespace Database\Factories;

use App\Models\{ Movie, User, Rating };
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    protected $model = Rating::class;

    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'movie_id' => Movie::factory()->create()->id,
            'rating' => $this->faker->numberBetween(1, 10),
        ];
    }
}
