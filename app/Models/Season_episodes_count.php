<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Season_episodes_count extends Model
{
    //
    protected $table = 'season_episodes_counts';
    public $fillable = ['film_id', 'season_number', 'episodes_count', 'episodes'];
    protected $dates = ['created_at', 'updated_at'];

    public function Film() {
        return $this->belongsTo(Film::class, 'id', 'film_id');
    }

}
