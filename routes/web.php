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


Route::get('/', 'MoviesController@index');
Route::get('/category', 'MoviesController@category');
Route::get('/item/{id}', 'MoviesController@show');
//Route::get('/category/comedy', 'MoviesController@itemsGenre');
//Route::get('/serials/comedy', 'MoviesController@itemsGenre');
