<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\{ TMDbService, MoviesService };

class MoviesSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:sync {count?} {consoleOutput?}';

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
    public function handle(TMDbService $tmdbService, MoviesService $moviesService)
    {
        $count = $this->argument('count') ?? null;
        $consoleOutput = $this->argument('consoleOutput') ?? true;
        $moviesService->fetchPopularMovies($count ?: $moviesService->getNumberOfAllMovies(), $consoleOutput);
    }
}
