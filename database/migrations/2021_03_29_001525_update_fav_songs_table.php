<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFavSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fav_songs', function (Blueprint $table) {
            //
            $table->foreign('song_id')->references('song_id')->on('songs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('user_id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fav_songs', function (Blueprint $table) {
            //
            $table->dropForeign(['song_id']);
            $table->dropForeign(['user_id']);
        });
    }
}
