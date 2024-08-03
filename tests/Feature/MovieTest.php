<?php

namespace Tests\Feature;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    public function test_movies_are_displayed(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('movies');

        $response->assertOk();
    }

    public function test_single_movie_is_displayed(): void
    {

        $user = User::factory()->create();

        $this->actingAs($user);

        $movie = Movie::factory()->create([
            'title' => 'Test Movie',
            'overview' => 'This is a test movie description.',
            'director' => "Majkl Dzordan",
            'release_date' => "2012-03-07",
            'image' => "testimage.url",
            'video_id' => "100",
            'backdrop_path' => "backdroppath.url",
        ]);

        $response = $this->get(route('movies.show', $movie->id));

        $response->assertOk();

        $response->assertSee($movie->title);
        $response->assertSee($movie->overview);
        $response->assertSee($movie->director);
        $response->assertSee($movie->release_date);
        $response->assertSee($movie->image);
        $response->assertSee($movie->video_id);
        $response->assertSee($movie->backdrop_path);
    }

    public function test_movie_can_be_created(): void
    {


        $user = User::factory()->create(['is_admin' => 1]);

        $this->actingAs($user);


        $response = $this->post(route('admin.movies.store'), [
            'title' => 'New Movie',
            'director' => 'Director Name',
            'release_date' => '2023-01-01',
            'views' => 150,
        ]);

        $response->assertRedirect(route('admin.movies.index'));

        $this->assertDatabaseHas('movies', [
            'title' => 'New Movie',
            'director' => 'Director Name',
            'release_date' => '2023-01-01',

        ]);
    }

    // WHEN OUR GREAT FRIEND BORIS MAKES EDIT FUNCTIONAL IN ADMIN PANEL, THIS TEST SHOULD WORK

    // public function test_is_movie_updated() 
    // {
    //     $user = User::factory()->create(['is_admin' => 1]);

    //     $this->actingAs($user);

    //     $movie = Movie::factory()->create([
    //         'id' => 50,
    //         'title' => 'Old Title',
    //         'director' => 'Old Director',
    //         'release_date' => '2010-01-01',
    //         'views' => 100,
    //     ]);

    //     $response = $this->put(route('admin.movies.update', $movie->id), [
    //         'title' => 'New Movie UPDATED',
    //         'director' => 'Director Name UPDATED',
    //         'release_date' => '2023-01-01',
    //         'views' => 130,
    //     ]);

    //     $response->assertRedirect(route('admin.movies.index'));

    //     $this->assertDatabaseHas('movies', [
    //         'title' => 'New Movie UPDATED',
    //         'director' => 'Director Name UPDATED',
    //         'release_date' => '2023-01-01',
    //         'views' => 130,
    //     ]);
    // }

    public function test_is_movie_destroyed()
    {

        $user = User::factory()->create(['is_admin' => 1]);

        $this->actingAs($user);

        $movie = Movie::factory()->create();

        $response = $this->delete(route('admin.movies.destroy', $movie->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.movies.index'));

        $this->assertDatabaseMissing('movies', ['id' => $movie->id]);

    }

}