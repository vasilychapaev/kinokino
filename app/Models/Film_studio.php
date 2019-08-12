<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film_studio extends Model
{
    //
    protected $table = 'film_studios';
    public $fillable = ['film_id', 'studio_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function Studio() {
        return $this->hasOne(Studio::class, 'id', 'studio_id');
    }
}
