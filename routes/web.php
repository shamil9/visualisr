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
    if (auth()->check()) return redirect()->route('visuals.index');

    return view('welcome');
})->name('index');

Route::get('/banned', function () {
    return view('banned');
})->name('banned');

// main nav
Route::get('/home', 'HomeController@index')->name('user.home');
Route::resource('/blog', 'BlogController');
Route::get('/faq', function () { return view('faq'); })->name('faq');
Route::get('/tos', function () { return view('tos'); })->name('tos');

// auth
Route::group(['middleware' => 'banned.check'], function () {
    Route::get('/login/twitter', 'Auth\Providers\Twitter@redirectToProvider')->name('twitter.login');
    Route::get('/login/twitter/callback', 'Auth\Providers\Twitter@handleProviderCallback')->name('twitter.login.callback');
    Route::get('/login/twitter/remove', 'Auth\Providers\Twitter@unlinkAccount')->name('twitter.unlink');
});
Auth::routes();

// comments
Route::resource('/visuals/{visual}/comments', 'CommentController');
Route::get('/comments/{id}/pagination', 'CommentController@pagination')->name('comments.pagination');

// visuals
Route::get('/visuals/rating', 'RatingController@ratings')->name('visuals.ratings');
Route::get('/visuals/views', 'RatingController@views')->name('visuals.views');
Route::post('/visuals/{visual}', 'VisualController@update')->name('visuals.update.post');
Route::resource('visuals', 'VisualController');

// ratings
Route::resource('ratings', 'RatingController');

// users
Route::patch('/users/{user}/toggle', 'UserController@toggleUserBannedStatus')->name('users.toggle.status');
Route::resource('users', 'UserController', ['except', ['show']]);
Route::get('/users/{slug}', 'UserController@show')->name('users.show');
Route::get('/home/favorites', 'HomeController@showFavorites')->name('user.favorites');
Route::get('/home/password', 'PasswordController@edit')->name('user.password');
Route::patch('/home/password', 'PasswordController@update')->name('user.password.update');
Route::get('/home/profile', 'ProfileController@edit')->name('user.profile');
Route::patch('/home/profile', 'ProfileController@update')->name('user.profile.update');
Route::get('/confirm/{toke}', 'UnconfirmedUserController@confirm')->name('user.confirm');


// favorite visual
Route::post('/favorites', 'FavoriteController@toggleFavorite')->name('favorites.toggle');

// support tickets
Route::resource('/contact', 'SupportTicketController');

// admin stats
Route::get('/admin/stats', 'StatsController@stats')->name('admin.stats');
Route::get('/admin/statscount', 'StatsController@statsCount')->name('admin.stats.count');
