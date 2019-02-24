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
    Route::post('/posts/uploadImages', 'PostsController@uploadImages');
    Route::post('/posts/addVideoLink', 'PostsController@addVideoLink');
    Route::post('/posts/setMainImage', 'PostsController@setMainImage');
    Route::post('/posts/deleteVideos', 'PostsController@deleteVideos');
    Route::post('/posts/deleteImages', 'PostsController@deleteImages');
});

Route::get('/', 'FrontendController@index');

Route::get('/posts', 'FrontendController@index');

Route::get('/post/{post}', 'FrontendController@getPost');


Route::get('/projects', 'FrontendController@projectList');

Route::get('/about', 'FrontendController@aboutMe');

Route::post('/get-json-posts', 'FrontendController@getJsonPosts');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
