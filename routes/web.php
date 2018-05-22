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

Route::get('/', 'PostsController@index')->name('home');

Route::get('/posts/create', 'PostsController@create')->name('create');

Route::post('/posts', 'PostsController@store');

Route::get('/posts/{post}', 'PostsController@show');

Route::get('/posts/tags/{tag}', 'TagsController@index');

Route::post('/posts/{post}/comments', 'CommentsController@store');

Route::get('/posts/{id}/edit', 'PostsController@edit')->name('edit');
Route::post('/posts/{id}/edit', 'PostsController@update')->name('update');

Route::get('/register', 'RegistrationController@create')->name('register');
Route::post('/register', 'RegistrationController@store');

Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy')->name('logout');

route::get('/profile', 'UserController@profile')->name('profile');
route::post('/profile', 'UserController@update_avatar')->name('update_avatar');

Route::get('/lists', 'ListsController@lists')->name('lists');

Route::get('/delete-post/{post_id}', 'PostsController@getDeletePost')->name('post-delete');



/*
 * posts
 *
 * GET /posts
 *
 * GET /posts/create
 *
 * POST /posts
 *
 * GET /posts/{id}/edit
 *
 * GET /posts/{id}
 *
 * PATCH /posts/{id}
 *
 * DELETE /posts/{id}
 *
 * */