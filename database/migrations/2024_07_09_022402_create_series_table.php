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
            $table->date('release_date')->nullable();
            $table->string('genre');
            $table->string('image')->nullable();
            $table->text('overview');
            $table->string('backdrop_path')->nullable();
            $table->integer('seasons')->default(1);
            $table->integer('episodes')->default(1);
            $table->json('cast');
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