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

Route::get('blog/{slug}',['as'=>'blog.single','uses'=>'BlogController@getSingle'])->where('slug','[\w\d\-\_]+');

Route::get('blog',['uses'=>'BlogController@getIndex','as'=>'blog.index']);

Route::get('contact', 'PagesController@getContact');
Route::post('contact', 'PagesController@postContact');

Route::get('about', 'PagesController@getAbout');

Route::get('/', 'PagesController@getIndex');

Route::resource('posts','PostController');

Auth::routes();




//categories routes
Route::resource('categories','CategoryController',['except'=>'create']);
Route::resource('tags','TagController',['except'=>'create']);

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Route::resource('comments','CommentsController',['except'=>['create']]);

//comments
Route::post('comments/{post_id}',['uses'=>'CommentController@store','as'=>'comments.store']);
Route::get('comments/{id}/edit',['uses'=>'CommentController@edit','as'=>'comments.edit']);
Route::put('comments/{id}',['uses'=>'CommentController@update','as'=>'comments.update']);
Route::delete('comments/{id}',['uses'=>'CommentController@destroy','as'=>'comments.destroy']);
Route::get('comments/{id}/delete',['uses'=>'CommentController@delete','as'=>'comments.delete']);