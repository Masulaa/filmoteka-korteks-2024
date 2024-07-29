<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Serie>
 */
class SerieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->realText($this->faker->numberBetween(10, 25)), // It looks like a movie title
            'director' => $this->faker->name,
            'release_date' => $this->faker->date,
            'genre' => "serie",
            'image' => $this->faker->imageUrl(),
            'trailer_link' => $this->faker->url(),
            'video_id' => $this->faker->randomNumber(),
            'backdrop_path' => $this->faker->imageUrl(),
        ];
    }
}
