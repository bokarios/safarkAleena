<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reservation;
use App\Trip;
use App\Client;
use DB;

use Illuminate\Http\Request;

class ReservationsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
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
		$resv = Reservation::where('id', '=', $id)->get()->first();
		$data['client'] = Client::where('id', '=', $resv->client_id)->get()->first();
		$data['trip'] = Trip::where('id', '=', $resv->trip_id)->get()->first();
		$data['trips'] = Trip::all();
		$data['resv'] = $resv;

		return view('reservations.edit')->with($data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$resv = Reservation::where('id', '=', $id)->get()->first();
		$old_trip = $resv->trip_id;
		$old_seats = $resv->booked_seats_num;
		$old_payed = $resv->payed;
		$old_pay_type = $resv->pay_type;
		$change = false;

		if($request->input('trip') != $old_trip) {
			//update trip
			$result = DB::table('reservations')->where('id', '=', $id)->update(['trip_id' => $request->input('trip')]);
			if($result) {
				$change = true;
			}
			else {
				return back()->with('warning', 'حصل خطأ اثناء العملية');
			}
		}

		if($request->input('seats') != $old_seats) {
			//update booked seats
			$result = DB::table('reservations')->where('id', '=', $id)->update(['booked_seats_num' => $request->input('seats')]);
			if($result) {
				$change = true;
			}
			else {
				return back()->with('warning', 'حصل خطأ اثناء العملية');
			}
		}

		if($request->input('payed') != $old_payed) {
			//update payed
			$result = DB::table('reservations')->where('id', '=', $id)->update(['payed' => $request->input('payed')]);
			if($result) {
				$change = true;
			}
			else {
				return back()->with('warning', 'حصل خطأ اثناء العملية');
			}
		}

		if($request->input('pay_type') != $old_pay_type) {
			//update pay type
			$result = DB::table('reservations')->where('id', '=', $id)->update(['pay_type' => $request->input('pay_type')]);
			if($result) {
				$change = true;
			}
			else {
				return back()->with('warning', 'حصل خطأ اثناء العملية');
			}
		}

		if($change) {
			return redirect('/panel')->with('success', 'تم تعديل معلومات الحجز')->withInput(['tab'=>'nav-reservation']);
		}
		else {
			return redirect('/panel')->with('info', 'لم تقم بتعديل معلومات الحجز')->withInput(['tab'=>'nav-reservation']);
		}
		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$result = Reservation::where('id', '=', $id)->delete();

		if($result) {
			return redirect('/panel')->with('success', 'تم حذف معلومات الحجز')->withInput(['tab'=>'nav-reservation']);
		}
		else {
			return redirect('/panel')->with('warning', 'حصل خطأ اثناء العملية حاول مرة اخرى')->withInput(['tab'=>'nav-reservation']);
		}
	}

}
