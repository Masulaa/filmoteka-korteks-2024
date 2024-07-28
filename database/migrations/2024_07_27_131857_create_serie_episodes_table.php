<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("serie_episodes", function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->foreignId("serie_id")->constrained()->onDelete("cascade");
            $table->integer("season_number");
            $table->integer("episode_number");
            $table->string("title");
            $table->string("video_id")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("serie_episodes");
    }
};
