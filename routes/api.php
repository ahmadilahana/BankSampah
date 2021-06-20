<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
	'namespace' => 'Api'
], function(){

	Route::group([
		'prefix' => 'User'
	], function(){
		Route::post('login', 'NasabahController@login');
		Route::post('register', 'NasabahController@register');
	});

	Route::group([
		'prefix' => 'Admin'
	], function(){
		Route::post('login', 'AdminController@login');
		// Route::post('register', 'AdminController@register');
	});

	Route::group([
		'middleware' => 'jwt.verify',
	], function(){
		Route::get('user', 'NasabahController@get_user');
	});
});
