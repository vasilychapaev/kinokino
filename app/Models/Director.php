<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
    //
    protected $table = 'directors';
    public $fillable = ['name', 'slug'];
    protected $dates = ['created_at', 'updated_at'];
}
