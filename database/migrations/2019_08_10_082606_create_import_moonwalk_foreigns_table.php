<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportMoonwalkForeignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_moonwalk_foreigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_ru');
            $table->string('title_en');
            $table->string('year');
            $table->string('duration');
            $table->string('kinopoisk_id');
            $table->string('world_art_id');
            $table->string('pornolab_id');
            $table->string('token');
            $table->string('type');
            $table->string('camrip');
            $table->string('source_type');
            $table->string('source_quality_type');
            $table->string('instream_ads');
            $table->string('directors_version');
            $table->string('iframe_url');
            $table->string('trailer_token');
            $table->string('trailer_iframe_url');
            $table->string('translator');
            $table->string('translator_id');
            $table->string('added_at');
            $table->string('category');
            $table->string('block');
            $table->string('material_data');
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
        Schema::dropIfExists('import_moonwalk_foreigns');
    }
}
