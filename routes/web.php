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
Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth','verified']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('posts', 'PostController');
    Route::get('/settings', 'UserController@getProfile')->name('user.getProfile');
    Route::post('/settings/update', 'UserController@updateProfile')->name('user.updateProfile');
    Route::get('/settings/password', 'UserController@getChangePassword')->name('user.getChangePassword');
    Route::post('/settings/password/update', 'UserController@changePassword')->name('user.changePassword');
    Route::get('/{username}', 'ProfileController@showProfile')->name('user.profile');
    Route::post('/{username}/update-avatar', 'ProfileController@updateAvatar')->name('user.updateAvatar');
    Route::post('follow', 'HomeController@followUserRequest')->name('user.follow');
    Route::resource('comments', 'CommentController');
    Route::post('like', 'PostController@likePost')->name('likePost');
    Route::get('/search-people', 'UserController@getSearchPeopleList')->name('search.people');
});

