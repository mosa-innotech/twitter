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

Route::get('/home', 'TweetsController@index')->name('tweets');
Route::get('/user/{id}', 'UsersController@index')->name('user');
Route::post('/tweet', 'TweetsController@saveTweet')->name('savetweet');
Route::post('/comment', 'TweetsController@saveComment')->name('savecomment');
Route::delete('/delete-tweet', 'TweetsController@deleteTweet');
Route::post('/follow', 'UsersController@follow');
