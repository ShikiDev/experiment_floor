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

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware' => ['auth','confirmed']], function () {
    Route::get('/', 'DashboardController@dashboard')->name('admin.index');
    Route::resource('/posts', 'PostsController', ['as'=>'admin']);
    Route::resource('/hashtags', 'HashtagController', ['as'=>'admin']);
    Route::resource('/users', 'UsersController', ['as' => 'admin']);
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
