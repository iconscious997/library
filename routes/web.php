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