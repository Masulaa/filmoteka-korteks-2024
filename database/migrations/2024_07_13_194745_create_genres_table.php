<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        // ПРИВРЕМЕНО 
        $genreMapping = [
            28 => 'Action',
            12 => 'Adventure',
            16 => 'Animation',
            35 => 'Comedy',
            80 => 'Crime',
            18 => 'Drama',
            14 => 'Fantasy',
            27 => 'Horror',
            9648 => 'Mystery',
            878 => 'Science Fiction',
            10751 => 'Family'
        ];

        $genres = [];
        foreach ($genreMapping as $id => $name) {
            $genres[] = ['id' => $id, 'name' => $name];
        }

        DB::table('genres')->insert($genres);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genres');
    }
}
