<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source_Type extends Model
{
    //
    protected $table = 'source_types';
    public $fillable = ['name', 'slug'];
    protected $dates = ['created_at', 'updated_at'];
}
