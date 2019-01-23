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
Route::get('/ajax/products', 'PostsController@ajax');
Route::get('/posts/{id}', 'PostsController@show')->name('show');
Route::get('/posts/tags/{tag}', 'TagsController@index')->name('tag');
Route::get('/posts/ajax/tags/{tag}', 'TagsController@ajax');
Route::get('/register', 'RegistrationController@create')->name('register');
Route::post('/register', 'RegistrationController@store');
Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store');
Route::get('/author/{id}', 'AuthorController@index')->name('author');
Route::get('/author/{id}/ajax/products', 'AuthorController@ajax');
Route::get('/about', 'PostsController@about')->name('about');
Route::get('/contact', 'PostsController@getContact')->name('contact');
Route::post('/contact', 'PostsController@postContact')->name('contact');

Route::middleware(['auth:web'])->group(function () {
    Route::middleware(['is_admin'])->group(function () {
        Route::get('/admin/dashboard', 'AdminController@adminDashboard');
    });
    Route::get('/create/posts', 'PostsController@create')->name('create');
    Route::post('/posts', 'PostsController@store');
    Route::post('/posts/{post}/comments', 'CommentsController@store');
    Route::get('/posts/{id}/edit', 'PostsController@edit')->name('edit');
    Route::post('/posts/{id}/edit', 'PostsController@update')->name('update');
    Route::get('/logout', 'SessionsController@destroy')->name('logout');
    Route::get('/profile', 'UserProfileController@profile')->name('profile');
    Route::post('/profile', 'UserProfileController@update_avatar')->name('update_avatar');
    Route::get('/lists', 'ListsController@lists')->name('lists');
    Route::get('/lists/ajax/products', 'ListsController@ajax');
    Route::get('/delete-post/{post_id}', 'PostsController@getDeletePost')->name('post-delete');
    Route::post('/profile/name', 'UserProfileController@update_name')->name('update_name');
    Route::get('/comments/{id}/edit', 'CommentsController@editComment')->name('edit_comment');
    Route::post('/comments/{id}/edit', 'CommentsController@updateComment')->name('update_comment');
    Route::get('/delete-comment/{id}', 'CommentsController@deleteComment')->name('delete_comment');
    Route::post('/like', 'PostsController@likePost')->name('like');
});