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

Route::get('/', function () {
    return view('welcome');
});

// User routes
Auth::routes();

// Publisher routes
Route::get('/publisher/create', 'PublisherController@create')
    ->name('publisher.create');
Route::post('publisher/store', 'PublisherController@store')
    ->name('publisher.store');
Route::get('/publisher/edit/{id}', 'PublisherController@edit')
    ->name('publisher.edit');
Route::patch('/publisher/update/{id}', 'PublisherController@update')
    ->name('publisher.update');

// Author routes
Route::get('/author/create', 'AuthorController@create')
    ->name('author.create');
Route::post('/author/store', 'AuthorController@store')
    ->name('author.store');
Route::get('/author/edit/{id}', 'AuthorController@edit')
    ->name('author.edit');
Route::patch('/author/update/{id}', 'AuthorController@update')
    ->name('author.update');

// Medium routes
Route::get('/medium/create', 'MediumController@create')
    ->name('medium.create');
Route::post('/medium/store', 'MediumController@store')
    ->name('medium.store');
Route::get('/medium/edit/{id}', 'MediumController@edit')
    ->name('medium.edit');
Route::patch('/medium/update/{id}', 'MediumController@update')
    ->name('medium.update');

// Shelf routes
Route::get('/shelf/create', 'ShelfController@create')
    ->name('shelf.create');
Route::post('/shelf/store', 'ShelfController@store')
    ->name('shelf.store');
Route::get('/shelf/edit/{id}', 'ShelfController@edit')
    ->name('shelf.edit');
Route::patch('/shelf/update/{id}', 'ShelfController@update')
    ->name('shelf.update');