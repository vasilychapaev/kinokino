<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film_actor extends Model
{
    //
    protected $table = 'film_actors';
    public $fillable = ['film_id', 'actor_id'];
    protected $dates = ['created_at', 'updated_at'];

    public function Actor() {
        return $this->hasOne(Actor::class, 'id', 'actor_id');
    }

}
