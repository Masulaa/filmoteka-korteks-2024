<?php

namespace App\Services;

use App\Models\Movie;
use GuzzleHttp\Client;

class TMDbService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

public function fetchPopularMovies($count)
{
    $syncCount = 0;
    $page = 1;

    do {
        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/movie/popular', [
            'query' => [
                'api_key' => env('TMDB_API_KEY'),
                'page' => $page,
            ],
        ]);

        $moviesData = json_decode($response->getBody(), true)['results'];

        foreach ($moviesData as $movieData) {
            $releaseDate = isset($movieData['release_date']) ? $movieData['release_date'] : null;

            Movie::updateOrCreate([
                'id' => $movieData['id'],
            ], [
                'title' => $movieData['title'],
                'director' => $this->getDirector($movieData['id']),
                'release_date' => $releaseDate,
                'genre' => isset($movieData['genre_ids']) ? implode(', ', $movieData['genre_ids']) : null,
                'image' => $movieData['poster_path'] ? 'https://image.tmdb.org/t/p/w500'.$movieData['poster_path'] : null,
            ]);

            $syncCount++;
            if ($syncCount >= $count) {
                break 2;
            }
        }

        $page++; 
    } while ($syncCount < $count);

    return $syncCount;
}

    
    protected function getDirector($movieId)
    {
        $response = $this->client->request('GET', "https://api.themoviedb.org/3/movie/{$movieId}/credits", [
            'query' => [
                'api_key' => env('TMDB_API_KEY'),
            ],
        ]);

        $creditsData = json_decode($response->getBody(), true);

        foreach ($creditsData['crew'] as $crewMember) {
            if ($crewMember['job'] === 'Director') {
                return $crewMember['name'];
            }
        }

        return null;
    }
}
