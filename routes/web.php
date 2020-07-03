<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('website.index');
});*/

Route::get('/', "PageController@index");

Route::get('/about', "PageController@about");

Route::get('/blog', "PageController@blog");

Route::get('/contact', "PageController@contact");

Route::get('/post/all/{cat?}',"PostController@cat_posts")->name("post.cat_index");

Route::resource('posts', 'PostController');

Route::resource('category', 'CategoryController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
