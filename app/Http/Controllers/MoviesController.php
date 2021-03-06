<?php

namespace App\Http\Controllers;

use App\Models\Actor;
use App\Models\Country;
use App\Models\Director;
use App\Models\Film;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MoviesController extends Controller
{
    public function index($type, $slug)
    {

        $title = 'Новинки на сайте ' . env('APP_NAME');

        $movies = Film::whereNotNull('poster');

        if ($type == 'search') {

            $movies->where(function ($q) use ($type, $slug) {
                $q->where('title_ru', 'like', '%' . $slug . '%');
                $q->orWhere('title_en', 'like', '%' . $slug . '%');
            });

            $title = 'Поиск по ' . $slug;

        }

        if ($type == 'year') {

            $movies->where(function ($q) use ($type, $slug) {
                $q->where('year', $slug);
            });

            $title = 'Поиск по ' . $slug . ' году';

        }

        if ($type == 'genre') {

            $title = 'Результаты поиска по ' . Genre::where('slug', $slug)->firstOrFail()->name;

            $movies->whereHas('FilmGenres.Genre', function ($q) use ($slug) {
                $q->where('slug', $slug);
            });
        }
        $movies->with('FilmGenres.Genre');

        if ($type == 'actor') {

            $title = 'Результаты поиска по ' . Actor::where('slug', $slug)->firstOrFail()->name;

            $movies->whereHas('FilmActors.Actor', function ($q) use ($slug) {
                $q->where('slug', $slug);
            });
        }
        $movies->with('FilmActors.Actor');


        if ($type == 'country') {

            $title = 'Результаты поиска по ' . Country::where('slug', $slug)->firstOrFail()->name;

            $movies->whereHas('FilmCountries.Country', function ($q) use ($slug) {
                $q->where('slug', $slug);
            });
        }
        $movies->with('FilmCountries.Country');

        if ($type == 'director') {

            $title = 'Результаты поиска по ' . Director::where('slug', $slug)->firstOrFail()->name;

            $movies->whereHas('FilmDirectors.Director', function ($q) use ($slug) {
                $q->where('slug', $slug);
            });
        }
        $movies->with('FilmDirectors.Director');

        // get all films
        $movies = $movies->orderby('updated_at', 'DESC')->Paginate(30);

        // get genres
        $genres = Cache::remember('genres', '3600', function () {
            return Genre::limit(20)->get();
        });
//        $genres = Cache::remember('genres1', '3600', function () {
//            return Genre::with('Film_genre')->limit(20)->get()->sortByDesc(function($q) {
//                return $q->Film_genre->count();
//            });
//        });

//        // get genres
//        $genres = Genre::with('Film_genre')->limit(20)->get();

        // get actors
        $actors = Cache::remember('actors', '3600', function () {
            return Actor::with('Film_actor')->limit(30)->get();
        });

        // get countries
        $countries = Cache::remember('countries', '3600', function () {
            return Country::with('Film_country')->limit(10)->get();
        });

        $sidbar = true;

        // SEO
        $seo_title = $title;

        return view('movies.index', compact('movies', 'title', 'genres', 'actors',
            'countries', 'sidbar', 'seo_title'));
    }

    public function main(Request $request) {

        $search = $request->search;
        $type = $search ? 'search' : '';
        return $this->index($type, $search);

    }

    public function cat($type, $slug)
    {
        if ($type == 'movie') {
            return $this->show($slug);
        } else {
            return $this->index($type, $slug);
        }
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

        $movie = Film::where('slug', $slug)->with('FilmGenres.Genre')->with('FilmDirectors.Director')
            ->with('FilmActors.Actor')->with('FilmCountries.Country')->firstOrFail();

        // https fix
        $movie->iframe_url = str_replace('http://moonwalk.cc', 'https://protectorat.cc', $movie->iframe_url);

        $genres = null;
        foreach ($movie->FilmGenres as $item) {
            $genres[] = '<a href="'.url('genre/'.$item->Genre->slug).'">'.$item->Genre->name.'</a>';
        }
        $genres = is_array($genres) ? implode(', ', $genres) : '';

        $actors = null;
        foreach ($movie->FilmActors as $item) {
            $actors[] = '<a href="'.url('actor/'.$item->Actor->slug).'">'.$item->Actor->name.'</a>';
        }
        $actors = is_array($actors) ? implode(', ', $actors) : '';

        $directors = null;
        foreach ($movie->FilmDirectors as $item) {
            $directors[] = '<a href="'.url('director/'.$item->Director->slug).'">'.$item->Director->name.'</a>';
        }
        $directors = is_array($directors) ? htmlspecialchars_decode(implode(', ', $directors)) : '';

        $countries = null;
        foreach ($movie->FilmCountries as $item) {
            $countries[] = '<a href="'.url('country/'.$item->Country->slug).'">'.$item->Country->name.'</a>';
        }
        $countries = is_array($countries) ? implode(', ', $countries) : '';

        $year = '<a href="'.url('year/'.$movie->year).'">'.$movie->year.'</a>';

        // SEO
        $seo_title = 'Смотреть ' . $movie->title_ru . "$movie->title_en ? ' - ' . $movie->title_en , ''" . $movie->year;
        $seo_description = $movie->description;
        $seo_key = $movie->title_ru . ', ' . $movie->year . ', ' . $movie->DisplayGenres();
        $seo_image = $movie->poster;

        return view('movies.show', compact('movie', 'genres', 'actors', 'countries', 'directors', 'year',
            'seo_title', 'seo_description', 'seo_key', 'seo_image'));
    }

}
