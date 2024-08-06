<?php

namespace Tests\Feature;


use App\Models\Serie;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SerieTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_series_are_displayed(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('series');

        $response->assertOk();
    }

    public function test_single_movie_is_displayed(): void
    {

        $user = User::factory()->create();

        $this->actingAs($user);

        $serie = Serie::factory()->create([
            'title' => 'Test Serie',
            'overview' => 'This is a test serie description.',
            'director' => "Majkl Dzordan",
            'release_date' => "2012-03-07",
            'image' => "testimage.url",
            'video_id' => "100",
            'backdrop_path' => "backdroppath.url",
        ]);

        $response = $this->get(route('series.show', $serie->id));

        $response->assertOk();

        $response->assertSee($serie->title);
        $response->assertSee($serie->overview);
        $response->assertSee($serie->director);
        $response->assertSee($serie->release_date);
        $response->assertSee($serie->image);
        $response->assertSee($serie->video_id);
        $response->assertSee($serie->backdrop_path);
    }

    public function test_serie_can_be_created(): void
    {


        $user = User::factory()->create(['is_admin' => 1]);

        $this->actingAs($user);


        $response = $this->post(route('admin.series.store'), [
            'title' => 'New Serie',
            'director' => 'Director Name',
            'release_date' => '2023-01-01',
            'views' => 150,
        ]);

        $response->assertRedirect(route('admin.series.index'));

        $this->assertDatabaseHas('series', [
            'title' => 'New Serie',
            'director' => 'Director Name',
            'release_date' => '2023-01-01',
            'views' => 150,
        ]);
    }


    public function test_is_serie_updated()
    {
        $user = User::factory()->create(['is_admin' => 1]);

        $this->actingAs($user);

        $serie = Serie::factory()->create([
            'id' => 50,
            'title' => 'Old Title',
            'director' => 'Old Director',
            'release_date' => '2010-01-01',
            'views' => 100,
        ]);

        $response = $this->put(route('admin.series.update', $serie->id), [
            'title' => 'New Serie UPDATED',
            'director' => 'Director Name UPDATED',
            'release_date' => '2023-01-01',
            'views' => 130,
        ]);

        $response->assertRedirect(route('admin.series.index'));

        $this->assertDatabaseHas('series', [
            'title' => 'New Serie UPDATED',
            'director' => 'Director Name UPDATED',
            'release_date' => '2023-01-01',
            'views' => 130,
        ]);
    }

    public function test_is_serie_destroyed()
    {

        $user = User::factory()->create(['is_admin' => 1]);

        $this->actingAs($user);

        $serie = Serie::factory()->create();

        $response = $this->delete(route('admin.series.destroy', $serie->id));

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.series.index'));

        $this->assertDatabaseMissing('series', ['id' => $serie->id]);

    }


}
