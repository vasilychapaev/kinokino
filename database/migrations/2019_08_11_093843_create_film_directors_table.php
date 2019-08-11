<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmDirectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_directors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('film_id')->unsigned()->index();
            $table->integer('director_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('film_id')->references('id')->on('films');
            $table->foreign('director_id')->references('id')->on('directors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('film_directors', function (Blueprint $table) {
            $table->dropForeign('film_directors_film_id_foreign');
            $table->dropForeign('film_directors_director_id_foreign');
        });
        Schema::dropIfExists('film_directors');
    }
}
