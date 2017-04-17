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
// Auth::loginUsingId(1);
Route::get('/', function () {
    if (auth()->check())
        return redirect()->route('user.home');

    return view('welcome');
})->name('index');

Route::get('login/twitter', 'Auth\Providers\Twitter@redirectToProvider')->name('twitter.login');
Route::get('login/twitter/callback', 'Auth\Providers\Twitter@handleProviderCallback')->name('twitter.login.callback');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('user.home');
Route::post('visuals/{visual}', 'VisualController@update');
Route::resource('visuals', 'VisualController');
