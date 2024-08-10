<?php

namespace Tests\Feature\Movie;

use App\Models\Movie;
use App\Models\User;
use Tests\TestCase;

class MovieWatchTest extends TestCase
{
    public function test_is_amount_of_views_going_up()
    {
        $movie = Movie::factory()->create(['views' => 0]);
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('movies.watch', $movie->id));

        $response->assertStatus(200);
        $response->assertViewHas('movie', $movie);
        $this->assertDatabaseHas('movies', [
            'id' => $movie->id,
            'views' => 1,
        ]);
    }

    public function test_can_user_watch_trailer()
    {
        $movie = Movie::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('movies.watchTrailer', $movie->id));

        $response->assertStatus(200);

        $response->assertViewIs('movie.watchTrailer');
        $response->assertViewHas('movie', $movie);
    }

    public function test_is_it_returning_404_if_film_doenst_exist()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('movies.watch', 2424));

        $response->assertStatus(404);
    }

    /** @test */
    public function test_is_it_returning_404_if_trailer_doenst_exist()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('movies.watchTrailer', 2424));

        $response->assertStatus(404);
    }
}
