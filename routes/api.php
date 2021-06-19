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
Route::post('login', 'Api\NasabahController@login');
Route::post('register', 'Api\NasabahController@register');

Route::group([
	'middleware' => 'jwt.verify',
], function(){
	Route::get('user', 'Api\NasabahController@get_user');
});
