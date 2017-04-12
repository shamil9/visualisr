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
Auth::loginUsingId(1);
Route::get('/', function () {
    if (auth()->check())
        return redirect()->route('user.home');

    return view('welcome');
})->name('index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('user.home');
Route::resource('visuals', 'VisualController');
