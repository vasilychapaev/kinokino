<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    //
    protected $table = 'films';
    public $fillable =
                    [
                        'title_ru', 'title_en', 'year', 'token', 'kinopoisk_id', 'world_art_id', 'added_at',
                        'category', 'type', 'source_type', 'iframe_url', 'token', 'trailer_iframe_url', 'trailer_token',
                        'duration_human', 'translator', 'added_at'
                    ];
    protected $dates = ['created_at', 'updated_at'];

}
