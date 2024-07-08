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
    public function fetchVideoUrlsFromGitHub()
    {
        $url = 'https://raw.githubusercontent.com/keseljevicjovan/filmoteka-database/master/movies.json';
        $json = file_get_contents($url);
        $data = json_decode($json, true);

        return $data;
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
    
        $moviesPerPage = 20;
    
        $totalPages = ceil($numberOfMoviesToDownload / $moviesPerPage);
    
        while ($page <= $totalPages) {
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
                    if ($syncCount >= $numberOfMoviesToDownload) {
                        break 2; 
                    }
    
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
    
                    $existingMovie = Movie::where('title', $movieData['title'])->first();
                    echo "($syncCount/$numberOfMoviesToDownload) ";
                    if ($existingMovie) {
                        if ($existingMovie->video_link !== $videoLink) {
                            $existingMovie->update([
                                'video_link' => $videoLink,
                            ]);
                            echo "Movie '{$movieTitle}' \033[31mupdated\033[0m with new video link.\n";
                        } else {
                            echo "Movie '{$movieTitle}' already exists.\033[35m Skip.\033[0m\n";
                        }
                    } else {
                        $director = $this->getDirector($movieData['id']);
                        if ($director === null) {
                            $director = 'unknown director';
                        }
                        Movie::create([
                            'title' => $movieData['title'],
                            'director' => $director,
                            'release_date' => isset($movieData['release_date']) ? date('Y-m-d', strtotime($movieData['release_date'])) : null,
                            'genre' => $genreString,
                            'image' => $movieData['poster_path'] ? 'https://image.tmdb.org/t/p/w500'.$movieData['poster_path'] : null,
                            'overview' => $movieData['overview'] ?? null,
                            'backdrop_path' => $movieData['backdrop_path'] ? 'https://image.tmdb.org/t/p/original'.$movieData['backdrop_path'] : null,
                            'cast' => $this->getCast($movieData['id']),
                            'video_link' => $videoLink,
                        ]);
                        echo "\033[33mNew\033[0m movie '{$movieTitle}' added to the database.";
                        if($videoLink!=null){
                            echo " (\033[32mHas Video\033[0m) ";
                        }
                        echo "\n";
                    }
    
                    $syncCount++;
                }
    
                //sleep(5);
    
            } catch (\Exception $e) {
                echo "An error occurred: {$e->getMessage()}";
                sleep(5);
            }
    
            $page++;
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