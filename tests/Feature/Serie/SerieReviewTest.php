<?php

namespace Tests\Feature\Serie;

use App\Models\User;
use App\Models\Movie;
use Tests\TestCase;

class SerieReviewTest extends TestCase
{
    public function test_can_you_add_review()
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('movies.reviews.store', $movie->id), [
            'content' => 'Great film!',
        ]);

        $this->assertDatabaseHas('movie_reviews', [
            'movie_id' => $movie->id,
            'user_id' => $user->id,
            'content' => 'Great film!',
        ]);

        $response->assertSessionHas('success', 'Review added successfully');
    }
}
