<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title_ru')->nullable()->index();
            $table->string('title_en')->nullable()->index();
            $table->integer('year')->nullable();
            $table->integer('kinopoisk_id')->nullable()->index();
            $table->integer('world_art_id')->nullable();
            $table->integer('category')->unsigned()->nullable();
            $table->integer('type')->unsigned()->nullable();
            $table->integer('source_type')->unsigned()->nullable();
            $table->string('iframe_url')->nullable();
            $table->string('token')->nullable();
            $table->string('trailer_iframe_url')->nullable();
            $table->string('trailer_token')->nullable();
            $table->string('duration_human')->nullable();
            $table->integer('translator')->unsigned()->nullable();
            $table->string('added_at')->nullable();
            $table->timestamps();
        });

        Schema::table('films', function($table) {
            $table->engine = 'InnoDB';
            $table->foreign('category')->references('id')->on('categories');
            $table->foreign('type')->references('id')->on('types');
            $table->foreign('source_type')->references('id')->on('source_types');
            $table->foreign('translator')->references('id')->on('translators');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('films', function (Blueprint $table) {
            $table->dropForeign('films_category_foreign');
            $table->dropForeign('films_type_foreign');
            $table->dropForeign('films_source_type_foreign');
            $table->dropForeign('films_translator_foreign');
        });
        Schema::dropIfExists('films');
    }
}
