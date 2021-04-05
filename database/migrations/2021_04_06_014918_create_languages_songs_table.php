<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages_songs', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('language_id');
            $table->foreign('language_id')
                  ->references('language_id')
                  ->on('languages')
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
        Schema::dropIfExists('languages_songs');
    }
}
