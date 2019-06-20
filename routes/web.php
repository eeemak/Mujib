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
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'AdminDashboardHomeController@dashboard']);
    Route::get('profile', ['as' => 'profile', 'uses' => 'AdminDashboardHomeController@viewProfile']);
    //=======Admin==========
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('upload', ['as' => 'upload', 'uses' => 'AdminDashboardHomeController@viewUpload']);
    });
    //=======User==========
    Route::group(['middleware' => ['role:user']], function () {
    });
});
