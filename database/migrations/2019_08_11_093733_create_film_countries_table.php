<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_countries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('film_id')->unsigned()->index();
            $table->integer('country_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('film_id')->references('id')->on('films');
            $table->foreign('country_id')->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('film_countries', function (Blueprint $table) {
            $table->dropForeign('film_countries_film_id_foreign');
            $table->dropForeign('film_countries_country_id_foreign');
        });
        Schema::dropIfExists('film_countries');
    }
}
