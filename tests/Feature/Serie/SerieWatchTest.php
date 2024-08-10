<?php

namespace Tests\Feature\Serie;

use App\Models\Serie;
use App\Models\User;
use Tests\TestCase;

class SerieWatchTest extends TestCase
{
    public function test_is_amount_of_views_going_up()
    {
        $serie = Serie::factory()->create(['views' => 0]);
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('series.watch', $serie->id));

        $response->assertStatus(200);
        $response->assertViewHas('serie', $serie);
        $this->assertDatabaseHas('series', [
            'id' => $serie->id,
            'views' => 1,
        ]);
    }

    public function test_can_user_watch_trailer()
    {
        $serie = Serie::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('series.watchTrailer', $serie->id));

        $response->assertStatus(200);

        $response->assertViewIs('serie.watchTrailer');
        $response->assertViewHas('serie', $serie);
    }

    public function test_is_it_returning_404_if_serie_doenst_exist()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('series.watch', 2424));

        $response->assertStatus(404);
    }

    /** @test */
    public function test_is_it_returning_404_if_trailer_doenst_exist()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get(route('series.watchTrailer', 2424));

        $response->assertStatus(404);
    }
}
