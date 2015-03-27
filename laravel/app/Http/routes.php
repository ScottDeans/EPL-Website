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

Route::get('bookings', ['middleware' => 'auth','uses' => 'BookingsController@index']);
Route::get('bookings/create', ['middleware' => 'auth','uses' => 'BookingsController@create']);
Route::post('bookings/confirm', ['middleware' => 'auth','uses' => 'BookingsController@confirm']);
Route::post('bookings/store', ['middleware' => 'auth','uses' => 'BookingsController@store']);
Route::get('bookings/landing', ['middleware' => 'auth','uses' => 'BookingsController@landing']);
Route::get('kits', ['middleware' => 'auth','uses' => 'KitController@index']);
Route::get('transfers', ['middleware' => 'auth','uses' => 'TransfersController@index']);

Route::delete('associations/{booking_id}/{user_id}/destroy',['as' => 'associations.destroy', 'middleware'=>'auth', 'uses'=>'AssociationsController@destroy']);
Route::post('associations/{booking_id}/{user_id}/store',['as' => 'associations.store', 'middleware'=>'auth', 'uses'=>'AssociationsController@store']);

Route::group(['middleware'=>'auth'], function() {
    Route::resource('associations', 'AssociationsController', array( 'except'=>array('destroy', 'store')));
});

Route::resource('welcome', 'WelcomeController@index');

