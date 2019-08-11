<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_genres', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('film_id')->unsigned()->index();
            $table->integer('genre_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('film_id')->references('id')->on('films');
            $table->foreign('genre_id')->references('id')->on('genres');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('film_genres', function (Blueprint $table) {
            $table->dropForeign('film_genres_film_id_foreign');
            $table->dropForeign('film_genres_genre_id_foreign');
        });
        Schema::dropIfExists('film_genres');
    }
}
