<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText($this->faker->numberBetween(10,25)), //it looks like a movie title
            'director' => $this->faker->name,
            'release_date' => $this->faker->date,
            'genre' => "movie",
            'image' => $this->faker->imageUrl(),
        ];
    }
}
