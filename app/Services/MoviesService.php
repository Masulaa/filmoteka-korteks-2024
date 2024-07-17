<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use App\Models\{Movie, Genre, Cast};

class MoviesService
{
    public function __construct(
        protected TMDbService $tmdbService
    ) {}

    /**
     * Get the number of all movies.
     *
     * @return int
     * @throws GuzzleException
     */
    public function getNumberOfAllMovies(): int
    { return $this->tmdbService->fetchData('https://api.themoviedb.org/3/movie/popular', ['page' => 1])['total_results'] ?? 0; }

    /**
     * Get YouTube trailer ID for the given movie.
     *
     * @param int $movieId
     * @return string|null
     * @throws GuzzleException
     */
    public function getYouTubeTrailerId(int $movieId): ?string
    {
        $videos = $this->tmdbService->fetchData("https://api.themoviedb.org/3/movie/{$movieId}/videos", [])['results'] ?? [];
        foreach ($videos as $video) {
            if ($video['site'] === 'YouTube' && $video['type'] === 'Trailer')
                return $video['key'];
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
    public function getDirector(int $movieId): string
    {
        $crew = $this->tmdbService->fetchData("https://api.themoviedb.org/3/movie/{$movieId}/credits", [])['crew'] ?? [];
        foreach ($crew as $member) {
            if ($member['job'] === 'Director')
                return $member['name'];
        }
        return 'unknown director';
    }

    /**
     * Get the cast of the given movie.
     *
     * @param int $movieId
     * @return array
     * @throws GuzzleException
     */
    public function getCast(int $movieId): array
    {
        $cast = array_slice($this->tmdbService->fetchData("https://api.themoviedb.org/3/movie/{$movieId}/credits", [])['cast'] ?? [], 0, 10);
        return array_map(fn($actor) => [
            'name' => $actor['name'],
            'character' => $actor['character'],
            'profile_path' => $this->getUrl($actor['profile_path'], 'w185'),
            'id' => $actor['id']
        ], $cast);
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
     * Create or update a movie in the database.
     *
     * @param array $movieData
     * @return void
     */
    public function createOrUpdateMovie(array $movieData): void
    {
        $videoId = $this->getYouTubeTrailerId($movieData['id']);
        $existingGenres = Genre::whereIn('id', $movieData['genre_ids'])->pluck('id')->toArray();

        $movie = Movie::updateOrCreate(
            ['title' => $movieData['title']],
            [
                'director' => $this->getDirector($movieData['id']),
                'release_date' => isset($movieData['release_date']) ? date('Y-m-d', strtotime($movieData['release_date'])) : null,
                'image' => $this->getUrl($movieData['poster_path'], 'w500'),
                'overview' => $movieData['overview'] ?? null,
                'backdrop_path' => $this->getUrl($movieData['backdrop_path'], 'original'),
                'trailer_link' => $videoId,
                'video_id' => $movieData['id'],
            ]
        );

        $castData = $this->getCast($movieData['id']);
        foreach ($castData as $actorData) {
            Cast::updateOrCreate(
                ['movie_id' => $movie->id, 'actor_id' => $actorData['id']],
                [
                    'name' => $actorData['name'],
                    'character' => $actorData['character'],
                    'profile_path' => $actorData['profile_path'],
                ]
            );
        }
        $movie->genres()->sync($existingGenres);
    }

    /**
     * Process and synchronize a single movie's data.
     *
     * @param array $movieData The data of the movie to process.
     * @param int &$syncCount The count of movies synchronized so far.
     * @param int $numberOfMoviesToDownload The total number of movies to download.
     * @param int &$skipCount The count of movies that were skipped because they already exist in the database.
     * @param int &$newCount The count of new movies added to the database.
     * @param bool $consoleOutput
     * @return void
     */
    private function processMovieData(array $movieData, int &$syncCount, int $numberOfMoviesToDownload, int &$skipCount, int &$newCount, bool $consoleOutput): void
    {
        if (Movie::where('title', $movieData['title'])->exists()) {
            $consoleOutput && printf("\033[K($syncCount/$numberOfMoviesToDownload) Movie '{$movieData['title']}' already exists.\033[35m Skip\033[0m.\n");
            $skipCount++;
            return;
        }
        $this->createOrUpdateMovie($movieData);
        $newCount++;
        $consoleOutput && printf("\033[K($syncCount/$numberOfMoviesToDownload) \033[33mNew\033[0m movie '{$movieData['title']}' added to the database.\n");
    }

    /**
     * Fetch and synchronize popular movies from TMDb.
     *
     * @param int $numberOfMoviesToDownload
     * @param bool $consoleOutput
     * @return void
     * @throws GuzzleException
     */

    public function fetchPopularMovies(int $numberOfMoviesToDownload, bool $consoleOutput=false): void
    {
        $consoleOutput && printf("\033[34m::\033[0m Synchronizing movies from TMDb...\n");
        $syncCount = $skipCount = $newCount = $page = $progresstmp = 0;
        $totalPages = ceil($numberOfMoviesToDownload / 20);

        while ($page++ < $totalPages) {
            $moviesData = $this->tmdbService->fetchMoviesData($page);
            foreach ($moviesData as $movieData) {
                if ($syncCount >= $numberOfMoviesToDownload) { break 2; }
                $syncCount++;
                $progress = floor(($syncCount / $numberOfMoviesToDownload) * 100);
                //$bar = (str_repeat('#', floor($progress / 2)) . str_repeat('-', 50 - floor($progress / 2))); // default style
                $bar = (str_repeat(' ', floor($progress / 2)) . ($progresstmp = $progresstmp == 'c' ? 'C' : 'c') . str_repeat('•', 50 - floor($progress / 2))); // pacman style     
                $this->processMovieData($movieData, $syncCount, $numberOfMoviesToDownload, $skipCount, $newCount, $consoleOutput);
                $consoleOutput && printf("\033[K[$bar] $progress%%\r");
            }
        }
        $consoleOutput && printf("\033[KSuccessfully synchronized {$syncCount} movies.\nSkip: {$skipCount}\nNew: {$newCount}\n");
    }
}