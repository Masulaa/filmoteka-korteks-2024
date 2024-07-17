<?php

namespace App\Services;

use App\Models\Movie;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class TMDbService
{
    public function __construct(
        protected Client $client,
        protected MoviesService $moviesService
    ) {}

    /**
     * Fetch data from the given URL with query parameters.
     *
     * @param string $url
     * @param array $query
     * @return array
     * @throws GuzzleException
     */
    public function fetchData(string $url, array $query): array
    {
        try {
            $response = $this->client->request('GET', $url, ['query' => array_merge(['api_key' => env('TMDB_API_KEY')], $query)]);
            return json_decode($response->getBody(), true);
        } catch (GuzzleException $e) {
            echo "An error occurred: {$e->getMessage()}";
            return [];
        }
    }

    /**
     * Fetch popular movies from TMDb.
     *
     * @param int $numberOfMoviesToDownload
     * @return void
     */
    public function fetchPopularMovies(int $numberOfMoviesToDownload): void
    {
        echo "\033[34m::\033[0m Synchronizing movies from TMDb...\n";
        $syncCount = $skipCount = $newCount = $page = 0;
        $totalPages = ceil($numberOfMoviesToDownload / 20);

        while ($page++ < $totalPages) {
            $moviesData = $this->fetchData('https://api.themoviedb.org/3/movie/popular', ['page' => $page])['results'] ?? [];

            foreach ($moviesData as $movieData) {
                if ($syncCount >= $numberOfMoviesToDownload) {
                    break 2;
                }

                $syncCount++;
                $progress = floor(($syncCount / $numberOfMoviesToDownload) * 100);
                $bar = str_repeat('#', floor($progress / 2)) . str_repeat('-', 50 - floor($progress / 2));

                if (Movie::where('title', $movieData['title'])->exists()) {
                    echo "\033[K($syncCount/$numberOfMoviesToDownload) Movie '{$movieData['title']}' already exists.\033[35m Skip\033[0m.\n";
                    $skipCount++;
                    echo "[$bar] $progress%\r";
                    continue;
                }

                $this -> moviesService -> createOrUpdateMovie($movieData);
                $newCount++;
                echo "\033[K($syncCount/$numberOfMoviesToDownload) \033[33mNew\033[0m movie '{$movieData['title']}' added to the database.\n";
                echo "[$bar] $progress%\r";
            }
        }
        echo "\033[KSuccessfully synchronized {$syncCount} movies.\nSkip: {$skipCount}\nNew: {$newCount}\n";
    }
}