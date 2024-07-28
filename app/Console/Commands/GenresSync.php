<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\{ TMDbService, GenresService };

class GenresSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'genres:sync {count?} {consoleOutput?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronize movies from TheMovieDB';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(TMDbService $tmdbService, GenresService $moviesService)
    {
        $moviesService->fetchAndUpdateGenres();
    }
}

