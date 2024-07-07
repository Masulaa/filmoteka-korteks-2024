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

        $genreMapping = [
            28 => 'Action',
            12 => 'Adventure',
            16 => 'Animation',
            35 => 'Comedy',
            80 => 'Crime',
            18 => 'Drama',
            14 => 'Fantasy',
            27 => 'Horror',
            9648 => 'Mystery',
            878 => 'Science Fiction',
            10751 => 'Family',
        ];
    
        do {
            $response = $this->client->request('GET', 'https://api.themoviedb.org/3/movie/popular', [
                'query' => [
                    'api_key' => env('TMDB_API_KEY'),
                    'page' => $page,
                ],
            ]);
    
            $moviesData = json_decode($response->getBody(), true)['results'];
    
            print_r($moviesData);
            
            foreach ($moviesData as $movieData) {
                $genres = isset($movieData['genre_ids']) ? $movieData['genre_ids'] : [];
                $genreNames = [];
                foreach ($genres as $genreId) {
                    if (isset($genreMapping[$genreId])) {
                        $genreNames[] = $genreMapping[$genreId];
                    }
                }
                $genreString = implode(', ', $genreNames);
    
                Movie::updateOrCreate([
                    'id' => $movieData['id'],
                ], [
                    'title' => $movieData['title'],
                    'director' => $this->getDirector($movieData['id']),
                    'release_date' => isset($movieData['release_date']) ? date('Y-m-d', strtotime($movieData['release_date'])) : null,
                    'genre' => $genreString,
                    'image' => $movieData['poster_path'] ? 'https://image.tmdb.org/t/p/w500'.$movieData['poster_path'] : null,
                    'overview' => $movieData['overview'] ?? null,
                    'backdrop_path' => $movieData['backdrop_path'] ? 'https://image.tmdb.org/t/p/original'.$movieData['backdrop_path'] : null,
                    'cast' => $this->getCast($movieData['id']),
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
    
    protected function getCast($movieId)
    {
        $response = $this->client->request('GET', "https://api.themoviedb.org/3/movie/{$movieId}/credits", [
            'query' => [
                'api_key' => env('TMDB_API_KEY'),
            ],
        ]);
        $creditsData = json_decode($response->getBody(), true);
        
        $cast = array_slice($creditsData['cast'], 0, 10); // Get top 10 cast members
        
        $detailedCast = [];
        foreach ($cast as $actor) {
            $detailedCast[] = [
                'name' => $actor['name'],
                'character' => $actor['character'],
                'profile_path' => $actor['profile_path'] ? 'https://image.tmdb.org/t/p/w185' . $actor['profile_path'] : null,
                'id' => $actor['id']
            ];
        }
        
        return $detailedCast;
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
