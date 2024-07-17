<?php

//use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
/**
 * Command to synchronize movies from TheMovieDB.
 * @param int|null $count
 * @return void
 */
 /*
Artisan::command('synchronize:movies', function () {
    Artisan::call('movies:sync',['consoleOutput'=> 0]);
})->purpose('Synchronize movies from TheMovieDB')->dailyAt("03:00");
*/

Schedule::command('movies:sync 0')->dailyAt("03:00"); 