<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table = 'categories';
    public $fillable = ['name'];
    protected $dates = ['created_at', 'updated_at'];
}
