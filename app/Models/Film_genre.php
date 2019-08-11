<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film_genre extends Model
{
    //
    protected $table = 'film_genres';
    public $fillable = ['film_id', 'genre_id'];
    protected $dates = ['created_at', 'updated_at'];
}
