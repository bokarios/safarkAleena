<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reservation;
use DB;
use Illuminate\Http\Request;

class AdminsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Reservations view query
		$query_resv = '
			SELECT 
				resv.id as id, cl.name as client_name, cl.mobile as client_mobile, cl.location as client_location, bus.name as bus_name, 
				bus.type as bus_type, bus.seats_num as bus_seats, trp.source as trip_source, trp.destination as trip_destination, 
				trp.trip_start_time as trip_start, trp.attend_time as trip_attend, trp.price as trip_price, resv.booked_seats_num as booked_seats, 
				resv.created_at as created_at, resv.updated_at as updated_at
			FROM 
				reservations as resv, clients as cl, trips as trp, buses as bus
			WHERE 
				cl.id = resv.client_id AND trp.id = resv.trip_id AND bus.id = trp.bus_id
		';
		$data['reservations'] = DB::select($query_resv);
		
		return view('admins.index')->with($data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
