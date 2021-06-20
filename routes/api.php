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

		Route::post('login', 'UserController@login');
		Route::post('register', 'NasabahController@register');

	Route::group([
		'middleware' => ['jwt.verify', "role:Admin,Nasabah,Pengurus1,Pengurus2,Bendahara"],
	], function(){
		Route::get('user', 'UserController@get_user');
		Route::post('user/edit', 'UserController@edit_user');
	});
	
});
