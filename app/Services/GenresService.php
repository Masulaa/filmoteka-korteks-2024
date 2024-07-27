<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use App\Models\{ Genre };

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
    public function fetchAndUpdateGenres($consoleOutput=1): void
    {
        $consoleOutput && printf("\033[34m::\033[0m Synchronizing genres from TMDb...\n");

        $genresData = $this->tmdbService->fetchGenres();
        
        foreach ($genresData as $genreData) {
            Genre::updateOrCreate(
                ['id' => $genreData['id']],
                ['name' => $genreData['name']]
            );
            printf ("{$genreData['name']} -> {$genreData['id']}\n");
        }
        $consoleOutput && printf("\033[KSuccessfully synchronized genres\n");
    }
}