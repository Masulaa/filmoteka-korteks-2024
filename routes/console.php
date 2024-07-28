<?php

use Illuminate\Support\Facades\Schedule;

/**
 * Command to synchronize movies from TheMovieDB.
 * @param int|null $count
 * @param int|null $consoleOutput
 * @return void
 */
Schedule::command('movies:sync 0 0')->dailyAt("03:00"); 
Schedule::command('movies:sync 0 0')->dailyAt("03:00"); 
Schedule::command('movies:sync 0 0')->dailyAt("03:00"); 