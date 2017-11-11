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

Route::get('/confirmreminder', 'User\UserController@confirmReminder');

Route::group(['middleware' => 'iscmssecurity'], function () {
    Route::get('/notification/create', 'Notification\NotificationController@create');
    Route::post('/notification/mail', 'Notification\NotificationController@createMail');
    Route::post('/notification/send', 'Notification\NotificationController@send');
    Route::get('/bugreport/create', 'Bugreport\BugreportController@create');
    Route::post('/bugreport/store', 'Bugreport\BugreportController@store');
    Route::post('/bugreport/mail', 'Bugreport\BugreportController@createMail');

    Route::post('/pgp/verifysignature', 'Pgp\PgpController@verifySignature');
});

Route::group(['middleware' => 'checkguest'], function () {
    Route::get('/user/profile', 'Auth\ProfileController@show');
    Route::post('/user/profile', 'Auth\ProfileController@update');

    Route::get('/invite', 'Invite\InviteController@create');
    Route::post('/invite/store', 'Invite\InviteController@store');

    Route::get('/', 'Bugreport\BugreportController@index');
    Route::get('/bugreport/{id}', 'Bugreport\BugreportController@show');
});

Route::group(['middleware' => 'iscmsgarden'], function () {
    Route::get('/users', 'User\UserController@index');
});

Auth::routes();
