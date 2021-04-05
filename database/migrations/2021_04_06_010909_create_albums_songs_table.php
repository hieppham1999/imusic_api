<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums_songs', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('album_id');
            $table->foreign('album_id')
                  ->references('album_id')
                  ->on('albums')
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
        Schema::dropIfExists('albums_songs');
    }
}
