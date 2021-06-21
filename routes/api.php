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
		Route::post('user/forgot_password', 'ForgotPasswordController@postEmail');

	Route::group([
		'middleware' => ['jwt.verify', "role:Admin,Nasabah,Pengurus1,Pengurus2,Bendahara"],
	], function(){
		Route::get('user', 'UserController@get_user');
		Route::post('user/edit', 'UserController@edit_user');

		Route::post('user/reset_password', 'UserController@reset_password');
	});

	Route::group([
		'midlleware' => ['jwt.verify', 'role:admin'],

	],function(){
		Route::post('user/add', 'UserController@add_user');
		Route::post('user/edit/byadmin', 'UserController@edit_user_byadmin');
	});
	
});
