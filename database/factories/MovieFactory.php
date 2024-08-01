<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Genre;
use App\Models\MovieRating;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    protected $model = Movie::class;

    public function definition()
    {
        return [
            'title' => $this->faker->realText($this->faker->numberBetween(10, 25)),
            'director' => $this->faker->name,
            'release_date' => $this->faker->date,
            'image' => $this->faker->imageUrl(),
            'trailer_link' => $this->faker->url(),
            'video_id' => $this->faker->randomNumber(),
            'backdrop_path' => $this->faker->imageUrl(),
            'overview' => $this->faker->paragraph,
            'views' => $this->faker->numberBetween(100, 10000),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Movie $movie) {
            // Proveri da li ima dovoljno žanrova, ako ne kreiraj ih
            $genreCount = Genre::count();
            if ($genreCount < 3) {
                Genre::factory()->count(3 - $genreCount)->create();
            }

            // Pridruži nasumične žanrove filmu
            $genres = Genre::all()->random(rand(1, 3))->pluck('id');
            $movie->genres()->attach($genres);

            // Kreiraj ocene za film
            MovieRating::factory()->count(5)->create([
                'movie_id' => $movie->id,
            ]);
        });
    }
}
