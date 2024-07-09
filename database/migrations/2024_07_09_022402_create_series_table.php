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
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('creator');
            $table->date('first_air_date')->nullable();
            $table->string('genre');
            $table->string('image')->nullable();
            $table->text('overview');
            $table->string('backdrop_path')->nullable();
            $table->integer('number_of_seasons')->default(1);
            $table->integer('number_of_episodes')->default(1);
            $table->string('homepage')->nullable();
            $table->string('status')->nullable();
            $table->json('seasons')->nullable();
            $table->json('cast');
            $table->string('trailer_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};

