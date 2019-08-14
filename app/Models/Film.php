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
                        'duration_human', 'translator', 'poster', 'tagline', 'description', 'kinopoisk_rating',
                        'kinopoisk_votes', 'age', 'added_at'
                    ];
    protected $dates = ['created_at', 'updated_at'];

    public function FilmGenres() {
        return $this->hasMany(Film_genre::class, 'film_id', 'id');
    }

    public function DisplayGenres() {

        $genres = $this->FilmGenres;
        foreach ($genres as $genre) {
            $item[] = $genre->Genre->name;


        }
        if (isset($item)) {
            return str_limit(implode(', ', $item), '12', '...');
        }
        return null;
    }

    public function FilmDirectors() {
        return $this->hasMany(Film_director::class, 'film_id', 'id');
    }

    public function FilmActors() {
        return $this->hasMany(Film_actor::class, 'film_id', 'id');
    }

    public function FilmCountries() {
        return $this->hasMany(Film_country::class, 'film_id', 'id');
    }

}
