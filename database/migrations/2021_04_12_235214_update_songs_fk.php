<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSongsFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->foreign('album_id')
                  ->references('album_id')
                  ->on('albums')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');   
            $table->foreign('language_id')
                  ->references('language_id')
                  ->on('languages')
                  ->onUpdate('cascade')
                  ->onDelete('set null');   
            $table->foreign('genre_id')
                  ->references('genre_id')
                  ->on('genres')
                  ->onUpdate('cascade')
                  ->onDelete('set null');   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->dropForeign(['album_id']);
            $table->dropForeign(['language_id']);
            $table->dropForeign(['genre_id']);
        });
    }
}
