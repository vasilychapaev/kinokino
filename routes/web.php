<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


Route::match(['get', 'post'], '/', 'MoviesController@main');
Route::post('search', 'MoviesController@search');
Route::get('category', 'MoviesController@category');
//Route::get('/movie/{slug}', 'MoviesController@show');
Route::get('{type}/{slug}', 'MoviesController@cat')->name('movie.detail');


//Route::get('/category/comedy', 'MoviesController@itemsGenre');
//Route::get('/serials/comedy', 'MoviesController@itemsGenre');
