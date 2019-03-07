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
    return view('landing');
});

Auth::routes();

Route::get('/home', 'TweetsController@index')->name('homepage');
Route::get('/edit-profile', 'UsersController@editProfileDisplay');
Route::post('/edit-profile', 'UsersController@editProfile');

Route::get('/user/{id}', 'UsersController@index')->name('user');

Route::get('/edit-tweet/{id}', 'TweetsController@editTweetDisplay');
Route::post('/edit-tweet', 'TweetsController@editTweet');

Route::post('/like-tweet', 'TweetsController@likeTweet');


Route::post('/tweet', 'TweetsController@saveTweet')->name('savetweet');
Route::post('/comment', 'TweetsController@saveComment')->name('savecomment');
Route::delete('/delete-tweet', 'TweetsController@deleteTweet');
Route::post('/follow', 'UsersController@follow');
