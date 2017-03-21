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
Route::get('/old', 'SearchController@getOld');

Route::controllers([
	'user' => 'UserController',
	'apply' => 'ApplyController',
	'search' => 'SearchController',
	'admin'	=>	'AdminController'
]);

Route::get('photo/{name}', 'PhotoController@photo');
Route::get('thumb/{name}', 'PhotoController@thumb');
Route::get('storage/app/ueditor/{name}', 'PhotoController@ueditor');
Route::get('admin/showonerecommendations/{apply_id}', function($apply_id){
return $apply_id;
});
