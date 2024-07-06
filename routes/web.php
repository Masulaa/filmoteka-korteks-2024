<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', function () {
    return redirect('home');
});

// Private
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/home', [MovieController::class, 'index'])->name('home');
    Route::get('/home/{movie}', [MovieController::class, 'show'])->name('movie');

    Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');    
    Route::post('/movies/{movie}/rate', [RatingController::class, 'store'])->name('movies.rate')->middleware('auth');
        
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
