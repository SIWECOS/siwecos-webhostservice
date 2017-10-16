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

Route::group(['middleware' => 'checkguest'], function () {
    Route::get('/invite', 'Invite\InviteController@create');
    Route::post('/invite/store', 'Invite\InviteController@store');

    Route::get('/', 'Bugreport\BugreportController@index');
});

Route::group(['middleware' => 'iscmssecurity'], function () {
    Route::get('/bugreport/create', 'Bugreport\BugreportController@create');
    Route::get('/bugreport/{id}', 'Bugreport\BugreportController@show');
    Route::post('/bugreport/store', 'Bugreport\BugreportController@store');
    Route::post('/bugreport/mail', 'Bugreport\BugreportController@createMail');

    Route::post('/pgp/verifysignature', 'Pgp\PgpController@verifySignature');
});

Auth::routes();
