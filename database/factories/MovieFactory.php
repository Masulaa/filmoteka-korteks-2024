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
            'release_date' => $this->faker->date(),
            'image' => $this->faker->imageUrl(),
            'overview' => $this->faker->paragraph(),
            'trailer_link' => $this->faker->url(),
            'video_id' => $this->faker->randomNumber(),
            'backdrop_path' => $this->faker->imageUrl(),
        ];
    }


}