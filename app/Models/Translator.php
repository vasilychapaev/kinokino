<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translator extends Model
{
    //
    protected $table = 'translators';
    public $fillable = ['name', 'slug'];
    protected $dates = ['created_at', 'updated_at'];
}
