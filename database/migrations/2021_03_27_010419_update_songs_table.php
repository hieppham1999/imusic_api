<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('songs', function (Blueprint $table) {
            $table->foreign('artist_id')->reference('artist_id')->on('artist')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('composer_id')->reference('composer_id')->on('composer')->onUpdate('cascade')->onDelete('cascade');
            //
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
            $table->dropForeign(['artist_id', 'composer_id']);
            //
        });
    }
}
