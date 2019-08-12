<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmStudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_studios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('film_id')->unsigned()->index();
            $table->integer('studio_id')->unsigned()->index();
            $table->timestamps();

            $table->foreign('film_id')->references('id')->on('films');
            $table->foreign('studio_id')->references('id')->on('studios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('film_studios', function (Blueprint $table) {
            $table->dropForeign('film_studios_film_id_foreign');
            $table->dropForeign('film_studios_studio_id_foreign');
        });
        Schema::dropIfExists('film_studios');
    }
}
