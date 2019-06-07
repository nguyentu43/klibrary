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

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/books', 'BookController');
    Route::get('/books/{book}/convert', 'BookController@convert')->name('books.convert');
    Route::patch('/books/{book}/restore', 'BookController@restore')->name('books.restore');
    Route::post('/books/{book}/send', 'BookController@send')->name('books.send');

    Route::resource('/collections', 'CollectionController');
    Route::resource('/devices', 'DeviceController')->except(['show']);
    Route::resource('/users', 'UserController')->middleware('can:index, App\Models\User');
    Route::get('/profile', 'ProfileController@edit')->name('profile.edit');
    Route::patch('/profile', 'ProfileController@update')->name('profile.update');

    Route::get('/jobs', 'JobController@index')->name('jobs.index');
    Route::delete('/jobs/{job}', 'JobController@destroy')->name('jobs.destroy');
});


