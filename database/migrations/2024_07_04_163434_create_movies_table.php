<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id(); 
            $table->string('title'); 
            $table->string('director'); 
            $table->date('release_date'); 
            $table->string('genre'); 
            $table->string('image')->nullable(); 
            $table->text('overview')->nullable(); 
            $table->string('video_link')->nullable();
            $table->text('cast')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
