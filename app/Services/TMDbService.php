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

    /*
    *  TODO:
    *  - Поправити bug који не учитава 1 видео послије (око) 400 fetch-oваних 
    *  (привремено рјешење је смањити $batchSize на 10 нпр, али ће то утицати на брзину преузимања)
    */

    public function getNumberOfAllMovies(){
        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/movie/popular', [
            'query' => [
                'api_key' => env('TMDB_API_KEY'),
                'page' => 1,
            ],
        ]);
    
        $totalMovies = json_decode($response->getBody(), true)['total_results'];
        return $totalMovies;
    }
    public function fetchPopularMovies($videoUrls, $numberOfMoviesToDownload)
    {
        $syncCount = 0;
        $page = 1;
        $nullResponseCount = 0;
    
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
    
        $totalMovies = $numberOfMoviesToDownload;
        $batchSize = 20; // max: 94, recommended: 20
        $totalPages = ceil($totalMovies / $batchSize);
    
        for ($page = 1; $page <= $totalPages; $page++) {
            try {
                $response = $this->client->request('GET', 'https://api.themoviedb.org/3/movie/popular', [
                    'query' => [
                        'api_key' => env('TMDB_API_KEY'),
                        'page' => $page,
                    ],
                ]);
    
                $moviesData = json_decode($response->getBody(), true)['results'];
    
                if (empty($moviesData)) {
                    $nullResponseCount++;
                    if ($nullResponseCount >= 5) {
                        echo "Received null responses 5 times in a row. Stopping synchronization.";
                        break;
                    }
                    sleep(2);
                    continue;
                } else {
                    $nullResponseCount = 0;
                }
    
                foreach ($moviesData as $movieData) {
                    $genres = isset($movieData['genre_ids']) ? $movieData['genre_ids'] : [];
                    $genreNames = [];
                    foreach ($genres as $genreId) {
                        if (isset($genreMapping[$genreId])) {
                            $genreNames[] = $genreMapping[$genreId];
                        }
                    }
                    $genreString = implode(', ', $genreNames);
                
                    $movieTitle = $movieData['title'];
                    $videoLink = isset($videoUrls[$movieTitle]) ? $videoUrls[$movieTitle] : null;
                    echo "Processing movie: {$movieTitle}, Video URL: {$videoLink}\n";
                
                    $existingMovie = Movie::where('title', $movieData['title'])->first();
                
                    if (!$existingMovie) {
                        Movie::create([
                            'title' => $movieData['title'],
                            'director' => $this->getDirector($movieData['id']),
                            'release_date' => isset($movieData['release_date']) ? date('Y-m-d', strtotime($movieData['release_date'])) : null,
                            'genre' => $genreString,
                            'image' => $movieData['poster_path'] ? 'https://image.tmdb.org/t/p/w500'.$movieData['poster_path'] : null,
                            'overview' => $movieData['overview'] ?? null,
                            'backdrop_path' => $movieData['backdrop_path'] ? 'https://image.tmdb.org/t/p/original'.$movieData['backdrop_path'] : null,
                            'cast' => $this->getCast($movieData['id']),
                            'video_link' => $videoLink,
                        ]);
                
                        $syncCount++;
                    } else {
                        echo "Movie '{$movieTitle}' already exists in database. Skip\n";
                    }
                }
                
                
    
                sleep(2);
    
            } catch (\Exception $e) {
                echo "An error occurred: {$e->getMessage()}";
                sleep(5);
            }
        }
    
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
