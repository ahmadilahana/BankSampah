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

Route::get('/', function () {
    return view('page.home');
});

Route::get('/user/nasabah', function () {
    return view('page.nasabah');
});
Route::get('/user/pengurus1', function () {
    return view('page.pengurus1');
});
Route::get('/user/pengurus2', function () {
    return view('page.pengurus2');
});
Route::get('/user/bendahara', function () {
    return view('page.bendahara');
});
