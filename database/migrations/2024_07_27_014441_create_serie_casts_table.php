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
        Schema::create('serie_casts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('serie_id');
            $table->foreign('serie_id')->references('id')->on('series')->onDelete('cascade');
            $table->string('name');
            $table->string('character');
            $table->string('profile_path')->nullable();
            $table->unsignedBigInteger('actor_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series_casts');
    }
};
