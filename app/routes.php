<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/photo/{id}', 'HomeController@photo');
Route::get('/about', 'HomeController@about');

Route::resource('photos', 'PhotoController');

Route::resource('photo_categories', 'PhotoCategoryController');