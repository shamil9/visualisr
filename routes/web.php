<?php

/*
-------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Auth::loginUsingId(2);
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('user.home');
    }

    return view('welcome');
})->name('index');

Route::get('/home', 'HomeController@index')->name('user.home');
Route::get('/home/favorites', 'HomeController@showFavorites')->name('user.favorites');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('/contact', 'HomeController@storeTicket')->name('contact.store');
Route::resource('blog', 'BlogController');

Route::get('login/twitter', 'Auth\Providers\Twitter@redirectToProvider')->name('twitter.login');
Route::get('login/twitter/callback', 'Auth\Providers\Twitter@handleProviderCallback')->name('twitter.login.callback');
Auth::routes();


Route::resource('visuals/{visual}/comments', 'CommentController');
Route::post('visuals/{visual}', 'VisualController@update')->name('visuals.update.post');
Route::resource('visuals', 'VisualController');

Route::resource('ratings', 'RatingController');

Route::post('favorites', 'FavoriteController@toggleFavorite')->name('favorites.toggle');
