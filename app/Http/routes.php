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

Route::get('/', 'SearchController@index');

Route::controllers([
	'user' => 'UserController',
	'apply' => 'ApplyController',
	'search' => 'SearchController'
]);

Route::get('thumb/{name}', 'PhotoController@thumb');

Route::resource('photo', 'PhotoController');