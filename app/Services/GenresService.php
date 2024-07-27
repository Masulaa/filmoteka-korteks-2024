<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use App\Models\{Movie, Genre, MovieCast};

class GenresService
{
    public function __construct(
        protected TMDbService $tmdbService
    ) {}

    /**
     * Fetch and update genres in the database.
     *
     * @return void
     * @throws GuzzleException
     */
    public function fetchAndUpdateGenres(): void
    {
        $genresData = $this->tmdbService->fetchGenres();
        
        foreach ($genresData as $genreData) {
            Genre::updateOrCreate(
                ['id' => $genreData['id']],
                ['name' => $genreData['name']]
            );
        }
    }
}