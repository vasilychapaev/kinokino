<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeasonEpisodesCountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season_episodes_counts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('film_id')->unsigned()->index();
            $table->integer('season_number')->unsigned()->nullable();
            $table->integer('episodes_count')->unsigned()->nullable();
            $table->text('episodes')->nullable();
            $table->timestamps();

            $table->foreign('film_id')->references('id')->on('films');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('season_episodes_counts', function (Blueprint $table) {
            $table->dropForeign('season_episodes_counts_film_id_foreign');
        });
        Schema::dropIfExists('season_episodes_counts');
    }
}
