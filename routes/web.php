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

Route::group(['middleware' => 'checkguest'], function()
{
	Route::get('/invite', 'Invite\InviteController@create');
	Route::post('/invite/store', 'Invite\InviteController@store');

	Route::get('/bugreport', 'Bugreport\BugreportController@create');
	Route::post('/bugreport/store', 'Bugreport\BugreportController@store');

	Route::get('/', function () {
		return view('dashboard');
	});
});

Auth::routes();
