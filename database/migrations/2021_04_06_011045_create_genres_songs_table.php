<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenresSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres_songs', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('genre_id');
            $table->foreign('genre_id')
                  ->references('genre_id')
                  ->on('genres')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('song_id');
            $table->foreign('song_id')
                  ->references('song_id')
                  ->on('songs')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genres_songs');
    }
}
