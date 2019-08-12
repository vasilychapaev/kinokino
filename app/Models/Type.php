<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //
    protected $table = 'types';
    public $fillable = ['name', 'slug'];
    protected $dates = ['created_at', 'updated_at'];
}
