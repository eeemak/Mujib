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

Route::get('/', 'HomeController@index');
Route::group(['middleware' => 'guest'], function () {
    Route::get('login', ['as' => 'login', 'uses' => 'HomeController@login']);
    Route::post('login', ['as' => 'attempt_login', 'uses' => 'HomeController@attemptLogin']);
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', ['as' => 'logout', 'uses' => 'HomeController@logout']);
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'HomeController@dashboard']);
    Route::get('profile', ['as' => 'profile', 'uses' => 'HomeController@viewProfile']);
});
