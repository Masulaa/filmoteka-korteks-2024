<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use App\Models\{Movie, Genre, Cast};

class MoviesService
{
    public function __construct() {}

    /**
     * Get the number of all movies.
     *
     * @return int
     * @throws GuzzleException
     */
    public function getNumberOfAllMovies(): int
    {
        $tmdbService = app(TMDbService::class); // ПРИВРЕМЕНО
        $response = $tmdbService->fetchData('https://api.themoviedb.org/3/movie/popular', ['page' => 1]);
        return $response['total_results'] ?? 0;
    }

    /**
     * Get YouTube trailer ID for the given movie.
     *
     * @param int $movieId
     * @return string|null
     * @throws GuzzleException
     */
    public function getYouTubeTrailerId(int $movieId): ?string
    {
        $tmdbService = app(TMDbService::class); // ПРИВРЕМЕНО
        $videos = $tmdbService->fetchData("https://api.themoviedb.org/3/movie/{$movieId}/videos", [])['results'] ?? [];
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
        $tmdbService = app(TMDbService::class); // ПРИВРЕМЕНО
        $crew = $tmdbService->fetchData("https://api.themoviedb.org/3/movie/{$movieId}/credits", [])['crew'] ?? [];
        foreach ($crew as $member) {
            if ($member['job'] === 'Director')
                return $member['name'];
        }
        return 'unknown director';
    }

    /**
     * Get the image URL for the given path and size.
     *
     * @param string|null $path
     * @param string $size
     * @return string|null
     */
    public function getImageUrl(?string $path, string $size = 'w500'): ?string
    {
        $tmdbService = app(TMDbService::class); // ПРИВРЕМЕНО
        return $tmdbService->getImageUrl($path, $size);
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
        $tmdbService = app(TMDbService::class); // ПРИВРЕМЕНО
        $cast = array_slice($tmdbService->fetchData("https://api.themoviedb.org/3/movie/{$movieId}/credits", [])['cast'] ?? [], 0, 10);
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
    {
        return $path ? "https://image.tmdb.org/t/p/{$size}{$path}" : null;
    }

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
            $cast = Cast::updateOrCreate(
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
}
