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
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', 'UserController@login');
Route::get('/logout', 'UserController@logout');
Route::group([
    'middleware' => 'auth',
], function(){

    Route::get('/', function () {
        return view('page.home');
    });
    Route::get('/profile', function () {
        return view('page.profile');
    });
    Route::get('/profile/edit', function () {
        return view('form.editprofile');
    });
    Route::post('/profile/edit/{id}', "UserController@update_user");

    //Nasabah
    Route::get('/user/nasabah', "NasabahController@get_user");
    Route::get('/user/nasabah/add', function () {
        return view('form.tambahnasabah');
    });
    Route::post('/user/nasabah/add', "NasabahController@add_user");
    Route::get('/user/nasabah/delete/{id}', "NasabahController@delete_user");
    Route::get('/user/nasabah/edit/{id}', "NasabahController@edit_user");
    Route::post('/user/nasabah/edit/{id}', "NasabahController@update_user");
    //End-Nasabah
    
    //Pengurus 1
    Route::get('/user/pengurus1', "Pengurus1Controller@get_user");
    Route::get('/user/pengurus1/add', function () {
        return view('form.tambahpengurus1');
    });
    Route::post('/user/pengurus1/add', "Pengurus1Controller@add_user");
    Route::get('/user/pengurus1/delete/{id}', "Pengurus1Controller@delete_user");
    Route::get('/user/pengurus1/edit/{id}', "Pengurus1Controller@edit_user");
    Route::post('/user/pengurus1/edit/{id}', "Pengurus1Controller@update_user");
    //End-Pengurus 1
    
    //Pengurus 2
    Route::get('/user/pengurus2', "Pengurus2Controller@get_user");
    Route::get('/user/pengurus2/add', function () {
        return view('form.tambahpengurus2');
    });
    Route::post('/user/pengurus2/add', "Pengurus2Controller@add_user");
    Route::get('/user/pengurus2/delete/{id}', "Pengurus2Controller@delete_user");
    Route::get('/user/pengurus2/edit/{id}', "Pengurus2Controller@edit_user");
    Route::post('/user/pengurus2/edit/{id}', "Pengurus2Controller@update_user");
    //End-Pengurus 2
    
    //Bendahara
    Route::get('/user/bendahara', 'BendaharaController@get_user');
    Route::get('/user/bendahara/add', function () {
        return view('form.tambahbendahara');
    });
    Route::post('/user/bendahara/add', "BendaharaController@add_user");
    Route::get('/user/bendahara/delete/{id}', "BendaharaController@delete_user");
    Route::get('/user/bendahara/edit/{id}', "BendaharaController@edit_user");
    Route::post('/user/bendahara/edit/{id}', "BendaharaController@update_user");
    //End-Bendahara
    
    //Jenis Sampah
    Route::get('/jenis_sampah', 'JenisSampahController@get_data');
    Route::get('/jenis_sampah/add', function () {
        return view('form.tambahJenisSampah');
    });
    Route::post('/jenis_sampah/add', "JenisSampahController@add_data");
    Route::get('/jenis_sampah/delete/{id}', "JenisSampahController@delete_data");
    Route::get('/jenis_sampah/edit/{id}', "JenisSampahController@edit_data");
    Route::post('/jenis_sampah/edit/{id}', "JenisSampahController@update_data");
    //END JENIS SAMPAH

    //SETORAN
    Route::get('/setoran', 'SetoranController@get_data');
});