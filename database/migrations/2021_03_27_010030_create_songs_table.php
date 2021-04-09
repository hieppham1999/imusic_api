<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id('song_id');
            $table->string('song_url')->unique();
            $table->string('title');
            $table->string('artist')->nullable();
            $table->unsignedBigInteger('album_id')->nullable();
            $table->integer('duration');
            $table->string('art_uri')->nullable();
            $table->dateTime('release_date')->nullable();
            $table->unsignedBigInteger('language_id')->nullable();
            $table->unsignedBigInteger('genre_id')->nullable();
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
        Schema::dropIfExists('songs');
    }
}
