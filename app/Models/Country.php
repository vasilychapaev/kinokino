<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table = 'countries';
    public $fillable = ['name'];
    protected $dates = ['created_at', 'updated_at'];
}
