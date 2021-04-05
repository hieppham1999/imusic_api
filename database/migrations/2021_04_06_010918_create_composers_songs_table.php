<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComposersSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('composers_songs', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('composer_id');
            $table->foreign('composer_id')
                  ->references('composer_id')
                  ->on('composers')
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
        Schema::dropIfExists('composers_songs');
    }
}
