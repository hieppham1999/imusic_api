<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecommendPointTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommend_point', function (Blueprint $table) {
            $table->id('recommend_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('genre_id');
            $table->unsignedBigInteger('language_id');
            $table->decimal('point', 8, 2)->default(0);
            $table->timestamps();
            $table->foreign('user_id')
                  ->references('user_id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreign('genre_id')
                  ->references('genre_id')
                  ->on('genres')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
            $table->foreign('language_id')
                  ->references('language_id')
                  ->on('languages')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recommend_point');
    }
}
