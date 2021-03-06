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

Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/books','BookController');

Route::get('/pages/{pageId}', 'PageController@show');
// Route::resource('pages/{pageId}','PageController');
// Route::resource('/books/{bookId}/pages','PageController');

Route::get('/main/list/{offset?}/{limit?}', 'MainController@listBooks');
Route::get('/main/{bookId}/pages', 'MainController@getBookPages');
Route::get('/main/page/{pageId}', 'MainController@showPage');
Route::get('/main/{bookId?}', 'MainController@index');


