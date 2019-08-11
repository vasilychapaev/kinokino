<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film_Country extends Model
{
    //
    protected $table = 'film_countries';
    public $fillable = ['film_id', 'country_id'];
    protected $dates = ['created_at', 'updated_at'];
}
