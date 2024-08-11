<?php

namespace Tests\Feature\Serie;

use App\Models\Serie;
use App\Models\Genre;
use App\Models\User;
use Tests\TestCase;

class SerieFilterTest extends TestCase
{
    public function test_series_filtered_by_genre()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $genre = Genre::factory()->create(['name' => 'Akcija']);
        $serie = Serie::factory()->create();
        $serie->genres()->attach($genre->id);

        $response = $this->get(route('series.filter', ['genre' => 'Akcija']));

        $response->assertStatus(200);
        $response->assertViewHas('movies', function ($series) use ($serie) {
            return $series->contains($serie);
        });
    }

    public function test_series_filtered_by_years()
    {

        $user = User::factory()->create();

        $serie = Serie::factory()->create(['release_date' => '2010-01-01']);

        $this->actingAs($user);

        $response = $this->get(route('series.filter', ['min_year' => 1995, 'max_year' => 2005]));

        $response->assertStatus(200);
    }

    public function test_series_filtered_by_views()
    {
        $user = User::factory()->create();

        $serie1 = Serie::factory()->create(['views' => 100]);
        $serie2 = Serie::factory()->create(['views' => 200]);

        $this->actingAs($user);

        $response = $this->get(route('series.filter', ['most_viewed' => true]));


        $response->assertStatus(200);
    }

}
