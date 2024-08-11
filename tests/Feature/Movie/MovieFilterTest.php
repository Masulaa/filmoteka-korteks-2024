<?php

namespace Tests\Feature\Movie;

use App\Models\Movie;
use App\Models\Genre;
use App\Models\User;
use Tests\TestCase;

class MovieFilterTest extends TestCase
{
    public function test_movies_filtered_by_genre()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $genre = Genre::factory()->create(['name' => 'Akcija']);
        $movie = Movie::factory()->create();
        $movie->genres()->attach($genre->id);

        $response = $this->get(route('movies.filter', ['genre' => 'Akcija']));

        $response->assertStatus(200);
        $response->assertViewHas('movies', function ($movies) use ($movie) {
            return $movies->contains($movie);
        });
    }

    public function test_movies_filtered_by_years()
    {

        $user = User::factory()->create();

        $movie = Movie::factory()->create(['release_date' => '2010-01-01']);

        $this->actingAs($user);

        $response = $this->get(route('movies.filter', ['min_year' => 1995, 'max_year' => 2005]));

        $response->assertStatus(200);
    }

    public function test_movies_filtered_by_views()
    {
        $user = User::factory()->create();

        $movie1 = Movie::factory()->create(['views' => 100]);
        $movie2 = Movie::factory()->create(['views' => 200]);

        $this->actingAs($user);

        $response = $this->get(route('movies.filter', ['most_viewed' => true]));


        $response->assertStatus(200);
    }

}
