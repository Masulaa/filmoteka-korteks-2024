<?php

namespace App\Services;

use App\Models\{ Movie, Genre };
use GuzzleHttp\{ Client, Exception\GuzzleException};

class TMDbService
{
    protected Client $client;
    protected array $genreMapping = [ 28 => 'Action', 12 => 'Adventure', 16 => 'Animation', 35 => 'Comedy', 80 => 'Crime', 18 => 'Drama', 14 => 'Fantasy', 27 => 'Horror', 9648 => 'Mystery', 878 => 'Science Fiction', 10751 => 'Family' ];
    public function __construct()
    { $this->client = new Client(); }

    /**
     * Get the number of all movies.
     *
     * @return int
     * @throws GuzzleException
     */
    public function getNumberOfAllMovies(): int
    { return $this->fetchData('https://api.themoviedb.org/3/movie/popular', ['page' => 1])['total_results']; }

    /**
     * Fetch popular movies from TMDb.
     *
     * @param int $numberOfMoviesToDownload
     * @return void
     */
    public function fetchPopularMovies(int $numberOfMoviesToDownload): void
    {
        echo "\033[34m::\033[0m Synchronizing movies from TMDb...\n";
        $syncCount = $skipCount = $newCount = $page = $nullResponseCount = 0;
        $totalPages = ceil($numberOfMoviesToDownload / 20);

        while ($page++ < $totalPages) {
            $moviesData = $this->fetchData('https://api.themoviedb.org/3/movie/popular', ['page' => $page])['results'] ?? [];
            if (empty($moviesData) && ++$nullResponseCount >= 5) break;

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

    /**
     * Fetch data from the given URL with query parameters.
     *
     * @param string $url
     * @param array $query
     * @return array
     * @throws GuzzleException
     */
    private function fetchData(string $url, array $query): array
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
     * Create or update a movie in the database.
     *
     * @param array $movieData
     * @return void
     * @throws GuzzleException
     */
    private function createOrUpdateMovie(array $movieData): void
    {
        $videoId = $this->getYouTubeTrailerId($movieData['id']);
    
        // Provera postojanja žanrova u bazi
        $existingGenres = Genre::whereIn('id', $movieData['genre_ids'])->pluck('id')->toArray();
    
        // Kreiranje ili ažuriranje filma
        $movie = Movie::updateOrCreate(
            ['title' => $movieData['title']],
            [
                'director' => $this->getDirector($movieData['id']),
                'release_date' => isset($movieData['release_date']) ? date('Y-m-d', strtotime($movieData['release_date'])) : null,
                'image' => $this->getUrl($movieData['poster_path'], 'w500'),
                'overview' => $movieData['overview'] ?? null,
                'backdrop_path' => $this->getUrl($movieData['backdrop_path'], 'original'),
                'cast' => $this->getCast($movieData['id']),
                'trailer_link' => $videoId,
                'video_id' => $movieData['id'],
                'genre_ids' => json_encode($movieData['genre_ids']),
            ]
        );
    
        // Sinhronizacija žanrova sa veznom tabelom movie_genre
        $movie->genres()->sync($existingGenres);
    }
    
    

    /**
     * Get YouTube trailer ID for the given movie.
     *
     * @param int $movieId
     * @return string|null
     * @throws GuzzleException
     */
    private function getYouTubeTrailerId(int $movieId): ?string
    {
        $videos = $this->fetchData("https://api.themoviedb.org/3/movie/{$movieId}/videos", [])['results'] ?? [];
        foreach ($videos as $video) {
            if ($video['site'] === 'YouTube' && $video['type'] === 'Trailer') return $video['key'];
        }
        return null;
    }

    /**
     * Get the director of the given movie.
     *
     * @param int $movieId
     * @return string
     * @throws GuzzleException
     */
    private function getDirector(int $movieId): string
    {
        $crew = $this->fetchData("https://api.themoviedb.org/3/movie/{$movieId}/credits", [])['crew'] ?? [];
        foreach ($crew as $member) {
            if ($member['job'] === 'Director') return $member['name'];
        }
        return 'unknown director';
    }

    /**
     * Get the URL for the given path and size.
     *
     * @param string|null $path
     * @param string $size
     * @return string|null
     */
    private function getUrl(?string $path, string $size): ?string
    { return $path ? "https://image.tmdb.org/t/p/{$size}{$path}" : null; }

    /**
     * Get the cast of the given movie.
     *
     * @param int $movieId
     * @return array
     * @throws GuzzleException
     */
    private function getCast(int $movieId): array
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