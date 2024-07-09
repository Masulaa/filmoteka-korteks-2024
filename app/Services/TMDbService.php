<?php

namespace App\Services;

use App\Models\Movie;
use App\Models\Series;
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

    public function getNumberOfAllSeries(){
        $response = $this->client->request('GET', 'https://api.themoviedb.org/3/tv/popular', [
            'query' => [
                'api_key' => env('TMDB_API_KEY'),
                'page' => 1,
            ],
        ]);

        $totalMovies = json_decode($response->getBody(), true)['total_results'];
        return $totalMovies;
    }

public function fetchPopularMovies($numberOfMoviesToDownload)
{
    echo "\033[34m::\033[0m Synchronizing movies from TMDb...\n";

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

                $videosResponse = $this->client->request('GET', "https://api.themoviedb.org/3/movie/{$movieData['id']}/videos", [
                    'query' => [
                        'api_key' => env('TMDB_API_KEY'),
                    ],
                ]);

                $videosData = json_decode($videosResponse->getBody(), true)['results'];

                $videoLink = null;
                foreach ($videosData as $video) {
                    if ($video['site'] == 'YouTube' && $video['type'] == 'Trailer') {
                        $videoId = $video['key'];
                        break;
                    }
                }

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
                        'trailer_link' => $videoId,
                        'video_id' => $movieData['id']
                    ]);
                    echo "\033[33mNew\033[0m movie '{$movieTitle}' added to the database.";
                    if ($videoLink != null) {
                        echo " (\033[32mHas Video\033[0m) ";
                    }
                    echo "\n";
                }

                $syncCount++;
            }

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

    public function fetchPopularSeries($numberOfSeriesToDownload)
    {
        echo "\033[34m::\033[0m Synchronizing TV series from TMDb...\n";
    
        $syncCount = 0;
        $page = 1;
        $nullResponseCount = 0;
    
        $genreMapping = [
            10759 => 'Action & Adventure',
            16 => 'Animation',
            35 => 'Comedy',
            80 => 'Crime',
            99 => 'Documentary',
            18 => 'Drama',
            10751 => 'Family',
            10762 => 'Kids',
            9648 => 'Mystery',
            10763 => 'News',
            10764 => 'Reality',
            10765 => 'Sci-Fi & Fantasy',
            10766 => 'Soap',
            10767 => 'Talk',
            10768 => 'War & Politics',
            37 => 'Western'
        ];
    
        $seriesPerPage = 20;
        $totalPages = ceil($numberOfSeriesToDownload / $seriesPerPage);
    
        while ($page <= $totalPages) {
            try {
                $response = $this->client->request('GET', 'https://api.themoviedb.org/3/tv/popular', [
                    'query' => [
                        'api_key' => env('TMDB_API_KEY'),
                        'page' => $page,
                    ],
                ]);
    
                $seriesData = json_decode($response->getBody(), true)['results'];
    
                if (empty($seriesData)) {
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
    
                foreach ($seriesData as $seriesItem) {
                    if ($syncCount >= $numberOfSeriesToDownload) {
                        break 2;
                    }
                    
                    $genres = isset($seriesItem['genre_ids']) ? $seriesItem['genre_ids'] : [];
                    $genreNames = [];
                    foreach ($genres as $genreId) {
                        if (isset($genreMapping[$genreId])) {
                            $genreNames[] = $genreMapping[$genreId];
                        }
                    }
                    $genreString = implode(', ', $genreNames);
    
                    $seriesTitle = $seriesItem['name'];
    
                    $videosResponse = $this->client->request('GET', "https://api.themoviedb.org/3/tv/{$seriesItem['id']}/videos", [
                        'query' => [
                            'api_key' => env('TMDB_API_KEY'),
                        ],
                    ]);
    
                    $videosData = json_decode($videosResponse->getBody(), true)['results'];
    
                    $videoLink = null;
                    foreach ($videosData as $video) {
                        if ($video['site'] == 'YouTube' && $video['type'] == 'Trailer') {
                            $videoLink = "https://www.youtube.com/watch?v={$video['key']}";
                            break;
                        }
                    }
    
                    $existingSeries = Series::where('title', $seriesItem['name'])->first();
                    echo "($syncCount/$numberOfSeriesToDownload) ";
                    if ($existingSeries) {
                        if ($existingSeries->video_link !== $videoLink) {
                            $existingSeries->update([
                                'video_link' => $videoLink,
                            ]);
                            echo "Series '{$seriesTitle}' \033[31mupdated\033[0m with new video link.\n";
                        } else {
                            echo "Series '{$seriesTitle}' already exists.\033[35m Skip.\033[0m\n";
                        }
                    } else {
                        $details = $this->getSeriesDetails($seriesItem['id']);
                        Series::create([
                            'title' => $seriesItem['name'],
                            'creator' => $details['creator'],
                            'number_of_episodes' => $details['number_of_episodes'],
                            'number_of_seasons' => $details['number_of_seasons'],
                            'homepage' => $details['homepage'],
                            'status' => $details['status'],
                            'seasons' => json_encode($details['seasons']),
                            'first_air_date' => isset($seriesItem['first_air_date']) ? date('Y-m-d', strtotime($seriesItem['first_air_date'])) : null,
                            'genre' => $genreString,
                            'image' => $seriesItem['poster_path'] ? 'https://image.tmdb.org/t/p/w500'.$seriesItem['poster_path'] : null,
                            'overview' => $seriesItem['overview'] ?? null,
                            'backdrop_path' => $seriesItem['backdrop_path'] ? 'https://image.tmdb.org/t/p/original'.$seriesItem['backdrop_path'] : null,
                            'cast' => $this->getSeriesCast($seriesItem['id']),
                            'trailer_link' => $videoLink
                        ]);
                        echo "\033[33mNew\033[0m series '{$seriesTitle}' added to the database.";
                        if ($videoLink != null) {
                            echo " (\033[32mHas Video\033[0m) ";
                        }
                        echo "\n";
                    }
    
                    $syncCount++;
                }
    
            } catch (\Exception $e) {
                echo "An error occurred: {$e->getMessage()}";
                sleep(5);
            }
    
            $page++;
        }
    
        return $syncCount;
    }
    
    protected function getSeriesCast($seriesId)
    {
        $response = $this->client->request('GET', "https://api.themoviedb.org/3/tv/{$seriesId}/credits", [
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
    
    protected function getSeriesDetails($seriesId)
    {
        $response = $this->client->request('GET', "https://api.themoviedb.org/3/tv/{$seriesId}", [
            'query' => [
                'api_key' => env('TMDB_API_KEY'),
            ],
        ]);
    
        $seriesData = json_decode($response->getBody(), true);
    
        $details = [];
    
        $details['creator'] = isset($seriesData['created_by']) && !empty($seriesData['created_by']) ? $seriesData['created_by'][0]['name'] : 'unknown creator';
        $details['number_of_episodes'] = $seriesData['number_of_episodes'] ?? null;
        $details['number_of_seasons'] = $seriesData['number_of_seasons'] ?? null;
        $details['homepage'] = $seriesData['homepage'] ?? null;
        $details['status'] = $seriesData['status'] ?? null;
        $details['seasons'] = $seriesData['seasons'] ?? [];
    
        return $details;
    }
    
    

}
