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
    if (auth()->check()) return redirect()->route('user.home');

    return view('welcome');
})->name('index');

// main nav
Route::get('/home', 'HomeController@index')->name('user.home');

// blog
Route::resource('blog', 'BlogController');

// auth
Route::get('login/twitter', 'Auth\Providers\Twitter@redirectToProvider')->name('twitter.login');
Route::get('login/twitter/callback', 'Auth\Providers\Twitter@handleProviderCallback')->name('twitter.login.callback');
Auth::routes();

// visuals
Route::resource('visuals/{visual}/comments', 'CommentController');
Route::post('visuals/{visual}', 'VisualController@update')->name('visuals.update.post');
Route::resource('visuals', 'VisualController');

// ratings
Route::resource('ratings', 'RatingController');

// users
Route::patch('users/{user}/toggle', 'UserController@toggleUserBannedStatus')->name('users.toggle.status');
Route::resource('users', 'UserController');
Route::get('/home/favorites', 'HomeController@showFavorites')->name('user.favorites');

// favorite visual
Route::post('favorites', 'FavoriteController@toggleFavorite')->name('favorites.toggle');

// support tickets
Route::resource('contact', 'SupportTicketController');

// admin stats
Route::get('/admin/stats', 'StatsController@stats')->name('admin.stats');
Route::get('/admin/statscount', 'StatsController@statsCount')->name('admin.stats.count');
