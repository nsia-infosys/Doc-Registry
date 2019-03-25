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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/books/list/{offset?}/{limit?}', 'BookController@listBooks');

Route::get('/books/{bookId}/pages', 'BookController@getBookPages');

Route::resource('/books','BookController');

// Route::resource('/books/{bookId}/pages','PageController');

Route::get('/main/{bookId?}', 'MainController@index');

