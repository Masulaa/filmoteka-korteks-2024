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
        Schema::create("series", function (Blueprint $table) {
            $table->id();
            $table->string("title")->index();
            $table->string("director")->index();
            $table->date("release_date")->index();
            $table->string("image")->nullable();
            $table->text("overview")->nullable();
            $table->string("trailer_link")->nullable();
            $table->string("video_id")->nullable();
            $table->string("backdrop_path")->nullable();
            $table->integer("views")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("series");
    }
};
