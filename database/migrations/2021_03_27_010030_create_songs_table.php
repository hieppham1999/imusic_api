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
            $table->string('album');
            $table->integer('duration');
            $table->dateTime('release_at');
            $table->string('art_uri');
            $table->timestamps();
            $table->integer('artist_id')->nullable();
            $table->integer('composer_id')->nullable();
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
