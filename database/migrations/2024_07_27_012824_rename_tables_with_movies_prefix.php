<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::rename('casts', 'movie_casts');
        Schema::rename('favorites', 'movie_favorites');
        Schema::rename('ratings', 'movie_ratings');
        Schema::rename('reviews', 'movie_reviews');
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('movie_casts','casts');
        Schema::rename('movie_favorites','favorites');
        Schema::rename('movie_ratings','ratings');
        Schema::rename('movie_reviews','reviews');
    }
};
