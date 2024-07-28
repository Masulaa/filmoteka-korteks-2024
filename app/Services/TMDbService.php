<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class TMDbService
{
    public function __construct(
        protected Client $client,
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
     * Fetch movie from TMDb.
     *
     * @param int $numberOfMoviesToDownload
     * @return array
     */
    public function fetchMoviesData(int $page): array
    { return $this->fetchData('https://api.themoviedb.org/3/movie/popular', ['page' => $page])['results'] ?? []; }

    /**
     * Fetch movie from TMDb.
     *
     * @param int $numberOfMoviesToDownload
     * @return array
     */
    public function fetchSeriesData(int $page): array
    { return $this->fetchData('https://api.themoviedb.org/3/tv/popular', ['page' => $page])['results'] ?? []; }


    /**
     * Fetch movie from TMDb.
     *
     * @return array
     */
    public function fetchGenres(): array
    { return $this->fetchData('https://api.themoviedb.org/3/genre/movie/list', ['language' => 'en-US'])['genres'] ?? []; }
}