<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->search;

        $movies = Film::where(function($q) use($search) {
            $q->whereNotNull('poster');
            if ($search) {
                $q->where('title_ru', 'like', '%'.$search.'%');
                $q->orWhere('title_en', 'like', '%'.$search.'%');
            }

        })->limit(30)->orderby('updated_at', 'DESC')->pluck('poster', 'id');

        $title = $search ? 'Результаты поиска по: ' . $search : 'Новинки на сайте';

        return view('movies.index', compact('movies', 'title'));
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
