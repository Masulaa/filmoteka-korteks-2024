<?php

namespace App\Services;

use App\Models\Movie;
use GuzzleHttp\Client;

class TMDbService
{
    protected $client;
    protected $genreMapping = [
        28 => 'Action', 12 => 'Adventure', 16 => 'Animation', 35 => 'Comedy', 80 => 'Crime', 18 => 'Drama', 14 => 'Fantasy', 27 => 'Horror', 9648 => 'Mystery', 878 => 'Science Fiction', 10751 => 'Family'
    ];

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getNumberOfAllMovies()
    {
        return $this->fetchData('https://api.themoviedb.org/3/movie/popular', ['page' => 1])['total_results'];
    }

    public function fetchPopularMovies($numberOfMoviesToDownload)
    {
        echo "\033[34m::\033[0m Synchronizing movies from TMDb...\n";
        $syncCount = $skipCount = $newCount = $page = $nullResponseCount = 0;
        $totalPages = ceil($numberOfMoviesToDownload / 20);

        while ($page++ < $totalPages) {
            $moviesData = $this->fetchData('https://api.themoviedb.org/3/movie/popular', ['page' => $page])['results'] ?? [];
            if (empty($moviesData) && ++$nullResponseCount >= 5) break;

            foreach ($moviesData as $movieData) {
                $syncCount++;
                $progress = floor(($syncCount / $numberOfMoviesToDownload) * 100);
                $bar = str_repeat('#', floor($progress / 2)) . str_repeat('-', 50 - floor($progress / 2));

                if (Movie::where('title', $movieData['title'])->exists()) {
                    echo "\033[K($syncCount/$numberOfMoviesToDownload) Movie '{$movieData['title']}' already exists.\033[35m Skip\033[0m.\n";
                    $skipCount++;
                } else {
                    $this->createOrUpdateMovie($movieData);
                    $newCount++;
                    echo "\033[K($syncCount/$numberOfMoviesToDownload) \033[33mNew\033[0m movie '{$movieData['title']}' added to the database.\n";
                }
                echo "[$bar] $progress%\r";
            }
        }
        echo "\033[KSuccessfully synchronized {$syncCount} movies.\nSkip: {$skipCount}\nNew: {$newCount}\n";
    }

    private function fetchData($url, $query)
    {
        try {
            $response = $this->client->request('GET', $url, ['query' => array_merge(['api_key' => env('TMDB_API_KEY')], $query)]);
            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            echo "An error occurred: {$e->getMessage()}";
            return [];
        }
    }

    private function createOrUpdateMovie($movieData)
    {
        $videoId = $this->getYouTubeTrailerId($movieData['id']);
        Movie::updateOrCreate(
            ['title' => $movieData['title']],
            [
                'director' => $this->getDirector($movieData['id']),
                'release_date' => isset($movieData['release_date']) ? date('Y-m-d', strtotime($movieData['release_date'])) : null,
                'genre' => $this->getGenres($movieData['genre_ids']),
                'image' => $this->getUrl($movieData['poster_path'], 'w500'),
                'overview' => $movieData['overview'] ?? null,
                'backdrop_path' => $this->getUrl($movieData['backdrop_path'], 'original'),
                'cast' => $this->getCast($movieData['id']),
                'trailer_link' => $videoId,
                'video_id' => $movieData['id']
            ]
        );
    }

    private function getYouTubeTrailerId($movieId)
    {
        $videos = $this->fetchData("https://api.themoviedb.org/3/movie/{$movieId}/videos", [])['results'] ?? [];
        foreach ($videos as $video) {
            if ($video['site'] === 'YouTube' && $video['type'] === 'Trailer') return $video['key'];
        }
        return null;
    }

    private function getDirector($movieId)
    {
        $crew = $this->fetchData("https://api.themoviedb.org/3/movie/{$movieId}/credits", [])['crew'] ?? [];
        foreach ($crew as $member) {
            if ($member['job'] === 'Director') return $member['name'];
        }
        return 'unknown director';
    }

    private function getGenres($genreIds)
    {
        return implode(', ', array_map(fn($id) => $this->genreMapping[$id] ?? '', $genreIds));
    }

    private function getUrl($path, $size)
    {
        return $path ? "https://image.tmdb.org/t/p/{$size}{$path}" : null;
    }

    private function getCast($movieId)
    {
        $cast = array_slice($this->fetchData("https://api.themoviedb.org/3/movie/{$movieId}/credits", [])['cast'] ?? [], 0, 10);
        return array_map(fn($actor) => [
            'name' => $actor['name'],
            'character' => $actor['character'],
            'profile_path' => $this->getUrl($actor['profile_path'], 'w185'),
            'id' => $actor['id']
        ], $cast);
    }
}