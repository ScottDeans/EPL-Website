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
Route::delete('bookings/{booking_id}/destroy',['as' => 'bookings.destroy', 'middleware'=>'auth', 'uses'=>'BookingsController@destroy']);
Route::get('bookings/create', ['middleware' => 'auth','uses' => 'BookingsController@create']);
Route::post('bookings/create_b', ['middleware' => 'auth','uses' => 'BookingsController@create_b']);
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

Route::delete('kitassociations/{booking_id}/{user_id}/destroy',['as' => 'kitassociations.destroy', 'middleware'=>'auth', 'uses'=>'KitAssociationsController@destroy']);
Route::post('kitassociations/{booking_id}/{user_id}/store',['as' => 'kitassociations.store', 'middleware'=>'auth', 'uses'=>'KitAssociationsController@store']);
Route::get('kitassociations/{kit_id}/show',['as' => 'kitassociations.show', 'middleware'=>'auth', 'uses'=>'KitAssociationsController@show']);
Route::group(['middleware'=>'auth'], function() {
    Route::resource('kitassociations', 'KitAssociationsController', array( 'except'=>array('destroy', 'store', 'show')));
});

Route::get('kits/showaddtype',['as' => 'kits.showaddtype', 'middleware'=>'auth', 'uses'=>'KitController@showaddtype']);
Route::get('kits/showadd',['as' => 'kits.showadd', 'middleware'=>'auth', 'uses'=>'KitController@showadd']);
Route::post('kits/{id}/add',['as' => 'kits.add', 'middleware'=>'auth', 'uses'=>'KitController@add']);
Route::delete('kits/{booking_id}/destroy',['as' => 'kits.destroy', 'middleware'=>'auth', 'uses'=>'KitController@destroy']);
Route::get('kits/{id}/report',['as' => 'kits.report', 'middleware'=>'auth', 'uses'=>'KitController@report']);
Route::post('kits/addkittype',['as' => 'kits.addkittype', 'middleware'=>'auth', 'uses'=>'KitController@addkittype']);
Route::get('kits/{id}/show',['as' => 'kits.show', 'middleware'=>'auth', 'uses'=>'KitController@show']);
Route::group(['middleware'=>'auth'], function() {
    Route::resource('kits', 'KitController', array( 'except'=>array('destroy','show','report','showadd','addkittype')));
});

Route::group(['middleware'=>'auth'], function() {
    Route::resource('usermgmt', 'AdminController');
});

Route::group(['middleware'=>'auth'], function() {
    Route::resource('transfers', 'TransfersController');
});

Route::group(['middleware'=>'auth'], function() {
    Route::resource('bookings', 'BookingsController', array( 'except'=>'destroy'));
});


Route::resource('welcome', 'WelcomeController@index');





