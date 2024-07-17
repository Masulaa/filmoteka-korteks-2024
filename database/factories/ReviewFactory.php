<?php

namespace Database\Factories;

use App\Models\{ User, Movie };
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->create()->id,
            'movie_id' => Movie::factory()->create()->id,
            'content' => $this->faker->paragraph(),
            'rating' => $this->faker->numberBetween(1, 10),
        ];
    }
}
