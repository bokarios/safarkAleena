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

/* Home Route */
Route::get('/', 'PagesController@index');
/* Add Admins Route */
Route::post('/admins/add', 'AdminsController@store');
/* Add Tripes Route */
Route::post('/tripes/add', 'TripesController@store');

/* Edit Reservations Route */
Route::get('/reservations/{id}/edit', 'ReservationsController@edit');
Route::post('/reservations/{id}/edit', 'ReservationsController@update');
/* Edit Tripes Route */
Route::get('/tripes/{id}/edit', 'TripesController@edit');
Route::post('/tripes/{id}/edit', 'TripesController@update');
/* Edit Delayed Reservations Route */
Route::get('/delayed/{id}/edit', 'DelayedReservationsController@edit');
Route::post('/delayed/{id}/edit', 'DelayedReservationsController@update');

/* Delete Reservations Route */
Route::get('/reservations/{id}/delete', 'ReservationsController@destroy');
/* Delete Tripes Route */
Route::get('/tripes/{id}/delete', 'TripesController@destroy');
/* Delete Reservations Route */
Route::get('/delayed/{id}/delete', 'DelayedReservationsController@destroy');

/* Refresh Reservations Route */
Route::post('/reservations/refresh', 'AdminsController@reservationsRefresh');

/* Search Reservations Route */
Route::post('/resv/search', 'AdminsController@reservationsSearch');

/* Refresh Delayed Reservations Route */
Route::post('/delayed/refresh', 'AdminsController@delayedRefresh');

/* Search Delayed Reservations Route */
Route::post('/delayed/search', 'AdminsController@delayedSearch');

/* Refresh Tripes Route */
Route::post('/tripes/refresh', 'AdminsController@tripesRefresh');

/* Search Tripes Route */
Route::post('/tripes/search', 'AdminsController@tripesSearch');

/* Buses Resources */
Route::resource('buses', 'BusesController');
/* Tripes Resources */
Route::resource('Tripes', 'TripesController');
/* Admins Resources */
Route::resource('admins', 'AdminsController');

/* User Authentication */
Route::get('users/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

/* Authenticated users */
Route::group(['middleware' => 'auth'], function()
{
	/* Admins Panel Route */
	Route::get('/panel', 'AdminsController@index');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
