<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'HomeController@index');

Route::get('/post/{id}', ['as' => 'home.post', 'uses' => 'HomeController@post']);

Route::group(['middleware' => 'admin'], function () {

    Route::get('/admin', 'AdminController@index');
    
    Route::resource('admin/users', 'AdminUsersController');

    Route::resource('admin/posts', 'AdminPostsController');

    Route::resource('admin/categories', 'AdminCategoriesController');

    Route::resource('admin/medias', 'AdminMediasController');
    Route::delete('delete/media', 'AdminMediasController@deleteMedia');

    Route::resource('admin/comments', 'PostCommentsController');

    Route::resource('admin/comments/replies', 'CommentRepliesController');

});

Route::group(['middleware' => 'auth'], function () {
    
    Route::post('comment/reply', 'CommentRepliesController@createReply');

});
