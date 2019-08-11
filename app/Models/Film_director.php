<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film_director extends Model
{
    //
    protected $table = 'film_directors';
    public $fillable = ['film_id', 'director_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function Director() {
        return $this->hasOne(Director::class, 'id', 'director_id');
    }

}
