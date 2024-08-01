<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    public function test_movies_are_displayed(): void
    {
        $movies = Movie::factory()->create();

        $response = $this
            ->actingAs($movies)
            ->get('/movies');

        $response->assertOk();
    }
}