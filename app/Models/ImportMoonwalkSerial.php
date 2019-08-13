<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportMoonwalkSerial extends Model
{
    //
    protected $table = 'import_moonwalk_serials';
    public $fillable = ['title_ru', 'title_en', 'year', 'token', 'type', 'kinopoisk_id', 'world_art_id',
        'translator', 'translator_id', 'iframe_url', 'trailer_token', 'trailer_iframe_url', 'seasons_count',
        'episodes_count', 'category', 'block', 'season_episodes_count', 'material_data', 'source_type',
        'duration'];
    protected $dates = ['created_at', 'updated_at'];
}
