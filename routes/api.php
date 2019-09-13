<?php 
//API ROUTES
Route::post('reserve', 'API\ReservationsApiController@clientReserve');
Route::get('trips', 'API\TripsApiController@getTrips');
