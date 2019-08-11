<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //
    protected $table = 'genres';
    public $fillable = ['name'];
    protected $dates = ['created_at', 'updated_at'];
}
