<?php

use Illuminate\Support\Facades\Route;

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





Route::post('/author/search', 'AuthorsController@search')->name('search_authors');
Route::post('/book/search', 'BooksController@search')->name('search_books');

Route::resource('author', 'AuthorsController');
Route::resource('book', 'BooksController');

Route::get('/', 'BooksController@index');

