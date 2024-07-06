<?php

namespace App\Services;

use GuzzleHttp\Client;

class TMDbService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.themoviedb.org/3/',
            'timeout'  => 10.0,
        ]);
        $this->apiKey = config('services.tmdb.api_key'); 
    }

    public function fetchPopularMovies()
    {
        $response = $this->client->request('GET', 'movie/popular', [
            'query' => [
                'api_key' => $this->apiKey,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
