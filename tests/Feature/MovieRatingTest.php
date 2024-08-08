<?php

namespace Tests\Feature;

use App\Models\Movie;
use App\Models\User;
use App\Models\MovieRating;
use Tests\TestCase;
use Illuminate\Support\Facades\Log;

class MovieRatingTest extends TestCase
{
    public function test_is_movie_rated(): void
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create();

        $this->actingAs($user);

        $data = [
            'rating' => 10,
        ];

        $response = $this->post(route('movies.rate', $movie), $data);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Rating saved successfully',
            ]);
    }

    public function test_movie_rate_cannot_be_added()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create();

        $this->actingAs($user);

        $data = [
            'rating' => 11,
        ];

        $response = $this->post(route('movies.rate', $movie), $data);

        $response->assertStatus(302);
    }

}
