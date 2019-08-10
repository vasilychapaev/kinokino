<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportMoonwalkForeign extends Model
{
    //
    protected $table = 'import_moonwalk_foreigns';
    public $fillable = ['title_ru', 'title_en', 'year', 'duration', 'kinopoisk_id', 'world_art_id', 'pornolab_id',
                        'token', 'type', 'camrip', 'source_type', 'source_quality_type', 'instream_ads',
                        'directors_version', 'iframe_url', 'trailer_token', 'trailer_iframe_url', 'translator',
                        'translator_id', 'added_at', 'category', 'block', 'material_data'];
    protected $dates = ['created_at', 'updated_at'];
}
