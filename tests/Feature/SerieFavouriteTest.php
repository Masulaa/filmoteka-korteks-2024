<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Serie;
use App\Models\User;

class SerieFavouriteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_serie_can_be_added_to_favorites()
    {
        $user = User::factory()->create();
        $serie = Serie::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('serie-favorites.store'), [
            'user_id' => $user->id,
            'serie_id' => $serie->id,
        ]);

        $response->assertStatus(201)
            ->assertJson(['message' => 'Serie added to favorites']);

        $this->assertDatabaseHas('serie_favorites', [
            'user_id' => $user->id,
            'serie_id' => $serie->id,
        ]);

        $response = $this->get(route('serie-favorites.index'));
        $response->assertStatus(200);
        $response->assertSee($serie->title);
    }

    public function test_user_can_view_favorite_series()
    {
        $user = User::factory()->create();
        $serie = Serie::factory()->create();

        $this->actingAs($user);


        $addFavourite = $this->post(route('serie-favorites.store'), [
            'user_id' => $user->id,
            'serie_id' => $serie->id,
        ]);

        $response = $this->get(route('serie-favorites.index'));

        $response->assertStatus(200);

        $response->assertSee($serie->title);

    }

    public function test_serie_cannot_be_added_to_favorites_multiple_times()
    {
        $user = User::factory()->create();
        $serie = Serie::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('serie-favorites.store'), [
            'user_id' => $user->id,
            'serie_id' => $serie->id,
        ]);

        $response->assertStatus(201)
            ->assertJson(['message' => 'Serie added to favorites']);

        $response = $this->post(route('serie-favorites.store'), [
            'user_id' => $user->id,
            'serie_id' => $serie->id,
        ]);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Serie is already in favorites']);
    }

    public function test_serie_can_be_removed_from_favorites()
    {
        $user = User::factory()->create();
        $serie = Serie::factory()->create();

        $this->actingAs($user);

        $response = $this->delete(route('serie-favorites.destroy', $serie->id), [
            'user_id' => $user->id,
            'serie_id' => $serie->id,
        ]);

        $response->assertStatus(404)
            ->assertJson([
                'message' => 'Favorite serie not found.',
                'success' => false,
            ]);
    }

}
