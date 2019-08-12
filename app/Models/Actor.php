<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    //
    protected $table = 'actors';
    public $fillable = ['name', 'slug'];
    protected $dates = ['created_at', 'updated_at'];
}
