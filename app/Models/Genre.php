<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //
    protected $table = 'genres';
    public $fillable = ['name', 'slug'];
    protected $dates = ['created_at', 'updated_at'];

    public function Film_genre() {
        return $this->hasMany(Film_genre::class, 'genre_id', 'id');
    }

}
