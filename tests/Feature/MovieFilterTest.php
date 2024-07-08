<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Movie;

class MovieFilterTest extends TestCase
{
    use RefreshDatabase;

    public function test_movies_can_be_filtered_by_genre()
    {
        $actionMovie = Movie::factory()->create(['genre' => 'Action']);
        $comedyMovie = Movie::factory()->create(['genre' => 'Comedy']);

        $response = $this->get('/movies/filter?genre=Action');

        $response->assertSee($actionMovie->title);
        $response->assertDontSee($comedyMovie->title);
    }

    public function test_movies_can_be_filtered_by_year()
    {
        $oldMovie = Movie::factory()->create(['release_date' => '1999-01-01']);
        $newMovie = Movie::factory()->create(['release_date' => '2022-01-01']);

        $response = $this->get('/movies/filter?year=2022');

        $response->assertSee($newMovie->title);
        $response->assertDontSee($oldMovie->title);
    }
}