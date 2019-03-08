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


/*
Route::get('/hello', function () {
    //return view('welcome');
    return '<h1>Hello World</h1>'
});

Route::get('/users/{id}/{name}', function($id, $name) {
    return 'This is user '.$name. ' with an id of '.$id;
});
*/

use MongoDB\Client as Mongo;

Route::get('/mongo', function(Request $request) {
    $collection = (new Mongo)->mydatabase->mycollection;
    return $collection->find()->toArray();
});

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

Route::resource('categories', 'CategoryController');
Route::resource('posts', 'PostsController');
Route::resource('tags', 'TagController');

Route::post('/comments/{post_id}', 'CommentsController@store')->name('comments.store');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
