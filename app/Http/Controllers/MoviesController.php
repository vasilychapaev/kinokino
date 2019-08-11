<?php

namespace App\Http\Controllers;

use App\Models\Film;
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

    public function show($id)
    {

        $movie = Film::find($id);
        return view('movies.show', compact('movie'));
    }
}
