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

		Route::post('/login', 'UserController@login');
		Route::post('/register', 'NasabahController@register');
		Route::post('/user/forgot_password', 'ForgotPasswordController@postEmail');

	Route::group([
		'middleware' => ['jwt.verify', "role:Admin,Nasabah,Pengurus1,Pengurus2,Bendahara"],
	], function(){
		Route::get('/user', 'UserController@get_user');
		Route::post('/user/edit', 'UserController@edit_user');

		Route::post('/user/reset_password', 'UserController@reset_password');
	});

	Route::group([
		'middleware' => ['jwt.verify', "role:Admin,Pengurus1,Pengurus2,Bendahara"],
	], function(){
		Route::get('/nasabah', 'NasabahController@get_all');
		Route::get('/jenis_sampah', 'JenisSampahController@get_jenis_sampah');
	});

	Route::group([
		'middleware' => ['jwt.verify', "role:Admin"],

	],function(){
		Route::post('/user/add', 'UserController@add_user');
		Route::post('/user/edit/{id}/byadmin', 'UserController@edit_user_byadmin');
	});

	Route::group([
		'middleware' => ['jwt.verify', "role:Nasabah"],

	],function(){
		Route::get('/bukutabungan', 'NasabahController@buku_tabungan');
		Route::get('/message/kontak/pengurus', 'MessageController@getPengurus');
	});
	
	Route::group([
		'middleware' => ['jwt.verify', 'role:Pengurus1'],
	], function(){
		Route::post('/setoran/add', 'SetoranController@add');
		Route::get('/setoran', 'SetoranController@get_data');
		Route::get('/message/kontak/nasabah', 'MessageController@getNasabah');
	});

	Route::group([
		'middleware' => ['jwt.verify', 'role:Pengurus2'],
	], function(){
		Route::post('/penjualan/add', 'PenjualanController@add');
		Route::get('/penjualan', 'PenjualanController@get_data');
	});
	
	Route::group([
		'middleware' => ['jwt.verify', 'role:Pengurus1,Nasabah'],
	],function(){
		Route::get('/message', 'MessageController@index');
		Route::post('/message/new/{id}', 'MessageController@sendMessage');
		Route::get('/message/{id}', 'MessageController@getMessage');
	});
});
