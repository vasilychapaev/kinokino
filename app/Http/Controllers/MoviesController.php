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

        $movie = Film::where('id', $id)->with('FilmGenres')->with('FilmDirectors')
            ->with('FilmActors')->with('FilmCountries')->first();

        $genres = Null;
        foreach ($movie->FilmGenres as $item) {
            $genres[] = $item->Genre->name;
        }
        $genres = implode(', ', $genres);

        $actors = Null;
        foreach ($movie->FilmActors as $item) {
            $actors[] = $item->Actor->name;
        }
        $actors = implode(', ', $actors);

        $directors = Null;
        foreach ($movie->FilmDirectors as $item) {
            $directors[] = $item->Director->name;
        }
        $directors = implode(', ', $directors);

        $countries = Null;
        foreach ($movie->FilmCountries as $item) {
            $countries[] = $item->Country->name;
        }
        $countries = implode(', ', $countries);


        return view('movies.show', compact('movie', 'genres', 'actors', 'countries', 'directors'));
    }

}
