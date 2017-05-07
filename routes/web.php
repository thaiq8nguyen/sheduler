<?php

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
    return view('home');
});

Route::get('appointments/confirm', 'AppointmentController@confirm');
Route::resource('appointments', 'AppointmentController');


Route::get('oauth', 'AppointmentController@oauth')->name('oauthCallback');