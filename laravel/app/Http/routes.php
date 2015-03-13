<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::get('bookings', ['middleware' => 'auth','uses' => 'BookingsController']);
Route::get('kits', ['middleware' => 'auth','uses' => 'KitController']);
Route::get('transfers', ['middleware' => 'auth','uses' => 'TransfersController']);
//Route::get('welcome', ['middleware' => 'auth','uses' => 'WelcomeController']);
//Route::resource('bookings', 'BookingsController');
//Route::resource('kits', 'KitController');
//Route::resource('admin', 'AdminController');
Route::resource('welcome', 'WelcomeController@index');
