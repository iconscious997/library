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

Route::get('/', 'BookController@index')
    ->name('home');

// User routes
Auth::routes();

// Search
Route::get('/book/search', 'SearchController@search')
    ->name('book.search');

// Book routes
Route::get('/book/create', 'BookController@create')
    ->name('book.create');
Route::post('/book/store', 'BookController@store')
    ->name('book.store');
Route::get('/book/edit/{id}', 'BookController@edit')
    ->name('book.edit');
Route::patch('/book/update/{id}', 'BookController@update')
    ->name('book.update');
Route::get('/book/{slug}', 'BookController@show')
    ->name('book.single');

// Publisher routes
Route::get('/publisher/create', 'PublisherController@create')
    ->name('publisher.create');
Route::post('publisher/store', 'PublisherController@store')
    ->name('publisher.store');
Route::get('/publisher/edit/{id}', 'PublisherController@edit')
    ->name('publisher.edit');
Route::patch('/publisher/update/{id}', 'PublisherController@update')
    ->name('publisher.update');
Route::get('/publisher/select', 'PublisherController@select')
    ->name('publisher.select');
Route::get('/publisher/{slug}', 'PublisherController@show')
    ->name('publisher.show');

// Author routes
Route::get('/author/create', 'AuthorController@create')
    ->name('author.create');
Route::post('/author/store', 'AuthorController@store')
    ->name('author.store');
Route::get('/author/edit/{id}', 'AuthorController@edit')
    ->name('author.edit');
Route::patch('/author/update/{id}', 'AuthorController@update')
    ->name('author.update');
Route::get('/author/select', 'AuthorController@select')
    ->name('author.select');
Route::get('/author/{slug}', 'AuthorController@show')
    ->name('author.show');

// Medium routes
Route::get('/medium/create', 'MediumController@create')
    ->name('medium.create');
Route::post('/medium/store', 'MediumController@store')
    ->name('medium.store');
Route::get('/medium/edit/{id}', 'MediumController@edit')
    ->name('medium.edit');
Route::patch('/medium/update/{id}', 'MediumController@update')
    ->name('medium.update');
Route::get('/medium/{slug}', 'MediumController@show')
    ->name('medium.show');

// Shelf routes
Route::get('/shelf/create', 'ShelfController@create')
    ->name('shelf.create');
Route::post('/shelf/store', 'ShelfController@store')
    ->name('shelf.store');
Route::get('/shelf/edit/{id}', 'ShelfController@edit')
    ->name('shelf.edit');
Route::patch('/shelf/update/{id}', 'ShelfController@update')
    ->name('shelf.update');
Route::get('/shelf/select', 'ShelfController@select')
    ->name('shelf.select');
Route::get('/shelf/{slug}', 'ShelfController@show')
    ->name('shelf.show');

// Tag routes
Route::get('/tag/create', 'TagController@create')
    ->name('tag.create');
Route::post('/tag/store', 'TagController@store')
    ->name('tag.store');
Route::get('/tag/edit/{id}', 'TagController@edit')
    ->name('tag.edit');
Route::patch('/tag/update/{id}', 'TagController@update')
    ->name('tag.update');
Route::get('/tag/select', 'TagController@select')
    ->name('tag.select');
Route::get('/tag/{slug}', 'TagController@show')
    ->name('tag.show');