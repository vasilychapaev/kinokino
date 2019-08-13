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
            $table->string('title_ru')->nullable();
            $table->string('title_en')->nullable();
            $table->string('year')->nullable();
            $table->string('duration')->nullable();
            $table->integer('kinopoisk_id')->nullable()->index();
            $table->string('world_art_id')->nullable();
            $table->string('pornolab_id')->nullable();
            $table->string('token')->nullable();
            $table->string('type')->nullable();
            $table->string('camrip')->nullable();
            $table->string('source_type')->nullable();
            $table->string('source_quality_type')->nullable();
            $table->string('instream_ads')->nullable();
            $table->string('directors_version')->nullable();
            $table->string('iframe_url')->nullable();
            $table->string('trailer_token')->nullable();
            $table->string('trailer_iframe_url')->nullable();
            $table->string('translator')->nullable();
            $table->string('translator_id')->nullable();
            $table->string('added_at')->nullable();
            $table->string('category')->nullable();
            $table->string('block')->nullable();
            $table->text('material_data')->nullable();
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
