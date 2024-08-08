<?php

namespace Tests\Feature;

use App\Models\Serie;
use App\Models\User;
use Tests\TestCase;

class SerieRatingTest extends TestCase
{
    public function test_is_serie_rated(): void
    {
        $user = User::factory()->create();
        $serie = Serie::factory()->create();

        $this->actingAs($user);

        $data = [
            'rating' => 10,
        ];

        $response = $this->post(route('series.rate', $serie), $data);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Rating saved successfully',
            ]);
    }

    public function test_serie_rate_cannot_be_added()
    {
        $user = User::factory()->create();
        $serie = Serie::factory()->create();

        $this->actingAs($user);

        $data = [
            'rating' => 11,
        ];

        $response = $this->post(route('series.rate', $serie), $data);

        $response->assertStatus(302);
    }
}
