<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Movie;
use App\Models\User;

class MovieFavouriteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_movie_can_be_added_to_favorites()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('movie-favorites.store'), [
            'user_id' => $user->id,
            'movie_id' => $movie->id,
        ]);

        $response->assertStatus(201)
            ->assertJson(['message' => 'Movie added to favorites']);

        $this->assertDatabaseHas('movie_favorites', [
            'user_id' => $user->id,
            'movie_id' => $movie->id,
        ]);

        $response = $this->get(route('movie-favorites.index'));
        $response->assertStatus(200);
        $response->assertSee($movie->title);
    }

    public function test_user_can_view_favorite_movies()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create();

        $this->actingAs($user);


        $addFavourite = $this->post(route('movie-favorites.store'), [
            'user_id' => $user->id,
            'movie_id' => $movie->id,
        ]);

        $response = $this->get(route('movie-favorites.index'));

        $response->assertStatus(200);

        $response->assertSee($movie->title);

    }

    public function test_movie_cannot_be_added_to_favorites_multiple_times()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('movie-favorites.store'), [
            'user_id' => $user->id,
            'movie_id' => $movie->id,
        ]);

        $response->assertStatus(201)
            ->assertJson(['message' => 'Movie added to favorites']);

        $response = $this->post(route('movie-favorites.store'), [
            'user_id' => $user->id,
            'movie_id' => $movie->id,
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Movie is already in favorites']);
    }

    public function test_movie_can_be_removed_from_favorites()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create();

        $this->actingAs($user);

        $response = $this->delete(route('movie-favorites.destroy', $movie->id), [
            'user_id' => $user->id,
            'movie_id' => $movie->id,
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Favorite movie not found.',
                'success' => false,
            ]);
    }



}
