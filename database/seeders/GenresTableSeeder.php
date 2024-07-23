<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class GenresTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client();
        $apiKey = config('services.tmdb.api_key'); 
        $response = $client->get("https://api.themoviedb.org/3/genre/movie/list", [
            'query' => ['api_key' => $apiKey, 'language' => 'en-US']
        ]);

        $genres = json_decode($response->getBody()->getContents(), true)['genres'];

        $genresData = [];
        foreach ($genres as $genre) {
            $genresData[] = ['id' => $genre['id'], 'name' => $genre['name']];
        }

        DB::table('genres')->insert($genresData);
    }
}
