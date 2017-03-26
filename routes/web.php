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
    return view('layouts/base');
});


Route::get('/invite', 'Invite\InviteController@create');
Route::post('/invite/store', 'Invite\InviteController@store');


Route::get('/bugreport', function () {
	return view('bugreport');
});
Auth::routes();

Route::get('/home', 'HomeController@index');
