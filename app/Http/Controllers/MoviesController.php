<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->search;

        $movies = Film::where(function ($q) use ($search) {
            $q->whereNotNull('poster');
            if ($search) {
                $q->where('title_ru', 'like', '%' . $search . '%');
                $q->orWhere('title_en', 'like', '%' . $search . '%');
            }

        })->limit(30)->orderby('updated_at', 'DESC')->pluck('poster', 'slug');

        $title = $search ? 'Результаты поиска по: ' . $search : 'Новинки на сайте';

        return view('movies.index', compact('movies', 'title'));
    }

    public function search(Request $request)
    {
        $movies = [];
        if ($search = $request->input('term')) {
            $movies = Film::select(['id', 'title_ru', 'title_en'])
                ->where(function ($q) use ($search) {
                    $q->whereNotNull('poster');
                    $q->where('title_ru', 'like', '%' . $search . '%');
                    $q->orWhere('title_en', 'like', '%' . $search . '%');

                })->limit(10)->orderby('updated_at', 'DESC')
                ->get();//->pluck('poster', 'slug');
        }

        return response()->json(['items' => $movies]);
    }

    public function category()
    {
        return view('movies.category');
    }

    public function show($slug)
    {

        $movie = Film::where('slug', $slug)->with('FilmGenres')->with('FilmDirectors')
            ->with('FilmActors')->with('FilmCountries')->firstOrFail();

        $genres = null;
        foreach ($movie->FilmGenres as $item) {
            $genres[] = $item->Genre->name;
        }
        $genres = is_array($genres) ? implode(', ', $genres) : '';

        $actors = null;
        foreach ($movie->FilmActors as $item) {
            $actors[] = $item->Actor->name;
        }
        $actors = is_array($actors) ? implode(', ', $actors) : '';

        $directors = null;
        foreach ($movie->FilmDirectors as $item) {
            $directors[] = $item->Director->name;
        }
        $directors = is_array($directors) ? implode(', ', $directors) : '';

        $countries = null;
        foreach ($movie->FilmCountries as $item) {
            $countries[] = $item->Country->name;
        }
        $countries = is_array($countries) ? implode(', ', $countries) : '';

        return view('movies.show', compact('movie', 'genres', 'actors', 'countries', 'directors'));
    }

}
