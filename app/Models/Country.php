<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table = 'countries';
    public $fillable = ['name', 'slug'];
    protected $dates = ['created_at', 'updated_at'];

    public function Film_country() {
        return $this->hasMany(Film_country::class, 'film_id', 'id');
    }

}
