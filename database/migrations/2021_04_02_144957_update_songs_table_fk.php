<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSongsTableFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            //
            $table->foreign('language_id')->references('language_id')->on('languages')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('genre_id')->references('genre_id')->on('genres')->onUpdate('cascade')->onDelete('cascade');
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
            //
            $table->dropForeign(['language_id']);
            $table->dropForeign(['genre_id']);
        });
    }
}
