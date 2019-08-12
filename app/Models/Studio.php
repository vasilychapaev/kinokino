<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    //
    protected $table = 'studios';
    public $fillable = ['name', 'slug'];
    protected $dates = ['created_at', 'updated_at'];
}
