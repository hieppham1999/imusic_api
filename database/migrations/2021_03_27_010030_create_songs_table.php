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
            $table->string('title');
            $table->unsignedBigInteger('artist_id')->nullable();
            $table->string('album');
            $table->integer('duration');
            $table->string('art_uri')->nullable();
            $table->dateTime('release_date')->nullable();
            $table->unsignedBigInteger('composer_id')->nullable();
            $table->unsignedBigInteger('language_id')->nullable();
            $table->unsignedBigInteger('genry_id')->nullable();
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
