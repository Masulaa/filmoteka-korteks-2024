<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\{ Schema, DB };
use GuzzleHttp\Client;

class CreateGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genres');
    }
}
