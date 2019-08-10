<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index()
    {

        return view('movies.index');
    }

    public function category()
    {
        return view('movies.category');
    }

    public function show()
    {
        return view('movies.show');
    }
}
