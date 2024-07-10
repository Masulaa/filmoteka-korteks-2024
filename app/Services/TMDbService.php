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

    public function fetchPopularMovies($numberOfMoviesToDownload)
    {
        echo "\033[34m::\033[0m Synchronizing movies from TMDb...\n";
        $syncCount = $page = $nullResponseCount = 0;
        $genreMapping = [28 => 'Action', 12 => 'Adventure', 16 => 'Animation', 35 => 'Comedy', 80 => 'Crime', 18 => 'Drama', 14 => 'Fantasy', 27 => 'Horror', 9648 => 'Mystery', 878 => 'Science Fiction', 10751 => 'Family'];
        $moviesPerPage = 20;
        $totalPages = ceil($numberOfMoviesToDownload / $moviesPerPage);
    
        while ($page++ < $totalPages) {
            try {
                $response = $this->client->request('GET', 'https://api.themoviedb.org/3/movie/popular', [
                    'query' => ['api_key' => env('TMDB_API_KEY'), 'page' => $page],
                ]);
                $moviesData = json_decode($response->getBody(), true)['results'];
                if (empty($moviesData) && ++$nullResponseCount >= 5) {
                    echo "Received null responses 5 times in a row. Stopping synchronization.";
                    break;
                }
                $nullResponseCount = empty($moviesData) ? ++$nullResponseCount : 0;
                foreach ($moviesData as $movieData) {
                    $syncCount++;
                    if ($syncCount >= $numberOfMoviesToDownload) break 2;
                    echo "($syncCount/$numberOfMoviesToDownload) ";
                    if (Movie::where('title', $movieData['title'])->exists()) {
                        echo "Movie '{$movieData['title']}' already exists.\033[35m Skip.\033[0m\n";
                        continue;
                    }
                    $videoId = $this->getYouTubeTrailerId($movieData['id']);
                    Movie::create([
                        'title' => $movieData['title'],
                        'director' => $this->getDirectorName($movieData['id']),
                        'release_date' => isset($movieData['release_date']) ? date('Y-m-d', strtotime($movieData['release_date'])) : null,
                        'genre' => $this->getGenres($movieData['genre_ids'], $genreMapping),
                        'image' => $this->getPosterUrl($movieData['poster_path']),
                        'overview' => $movieData['overview'] ?? null,
                        'backdrop_path' => $this->getBackdropUrl($movieData['backdrop_path']),
                        'cast' => $this->getCast($movieData['id']),
                        'trailer_link' => $videoId,
                        'video_id' => $movieData['id']
                    ]);
                    echo "\033[33mNew\033[0m movie '{$movieData['title']}' added to the database.\n";
                }
            } catch (\Exception $e) {
                echo "An error occurred: {$e->getMessage()}";
            }
        }
        echo "Successfully synchronized {$syncCount} movies.\n";
    }    

    private function getYouTubeTrailerId($movieId)
    {
        $response = $this->client->request('GET', "https://api.themoviedb.org/3/movie/{$movieId}/videos", [
            'query' => [
                'api_key' => env('TMDB_API_KEY'),
            ],
        ]);
        $videosData = json_decode($response->getBody(), true)['results'];
        foreach ($videosData as $video) {
            if ($video['site'] == 'YouTube' && $video['type'] == 'Trailer') {
                return $video['key'];
            }
        }
        return null;
    }

    private function getDirectorName($movieId)
    {
        $director = $this->getDirector($movieId);
        return $director === null ? 'unknown director' : $director;
    }

    private function getGenres($genreIds, $genreMapping)
    {
        $genreNames = [];
        foreach ($genreIds as $genreId) {
            if (isset($genreMapping[$genreId])) {
                $genreNames[] = $genreMapping[$genreId];
            }
        }
        return implode(', ', $genreNames);
    }

    private function getPosterUrl($posterPath)
    { return $posterPath ? 'https://image.tmdb.org/t/p/w500' . $posterPath : null; }

    private function getBackdropUrl($backdropPath)
    { return $backdropPath ? 'https://image.tmdb.org/t/p/original' . $backdropPath : null; }

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
