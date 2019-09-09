<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Trip;
use App\Bus;
use DB;
use Illuminate\Http\Request;

class TripesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('tripes.index');
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
	public function store(Request $request)
	{
		$output = '';

		if($request->input('bus') == '') {
			$output .= '
				<p class="alert alert-warning text-center">
					اختر الباص اولا
				</p>
			';
		}
		if($request->input('source') == '') {
			$output .= '
				<p class="alert alert-warning text-center">
					ادخل البداية اولا
				</p>
			';
		}
		if($request->input('destination') == '') {
			$output .= '
				<p class="alert alert-warning text-center">
					ادخل الوجهة اولا
				</p>
			';
		}
		if($request->input('attend') == '') {
			$output .= '
				<p class="alert alert-warning text-center">
					حدد زمن الحضور اولا
				</p>
			';
		}
		if($request->input('start') == '') {
			$output .= '
				<p class="alert alert-warning text-center">
					حدد زمن الانطلاق اولا
				</p>
			';
		}
		if($request->input('seats') == '') {
			$output .= '
				<p class="alert alert-warning text-center">
					ادخل عدد المقاعد اولا
				</p>
			';
		}
		if($request->input('price') == '') {
			$output .= '
				<p class="alert alert-warning text-center">
					ادخل سعر التذكرة اولا
				</p>
			';
		}

		if(
			$request->input('bus') != '' && 
			$request->input('source') != '' && 
			$request->input('destination') != '' &&
			$request->input('seats') != '' &&
			$request->input('attend') != '' &&
			$request->input('start') != '' &&
			$request->input('price') != ''
		) 
		{
			$trip = new Trip();
			$trip->bus_id = $request->input('bus');
			$trip->source = $request->input('source');
			$trip->destination = $request->input('destination');
			$trip->avilable_seats = $request->input('seats');
			$trip->trip_start_time = $request->input('start');
			$trip->attend_time = $request->input('attend');
			$trip->price = $request->input('price');
			$result = $trip->save();

			if($result) {
				$output .= '
				<p class="alert alert-success text-center">
					تمت اضافة الرحلة بنجاح
				</p>
			';
			}
			else {
				$output .= '
				<p class="alert alert-warning text-center">
					حصل خطأ اثناء العملية
				</p>
			';
			}
		}

		echo $output;
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
		$trip = Trip::where('id', '=', $id)->get()->first();
		$data['bus'] = Bus::where('id', '=', $trip->bus_id)->get()->first();
		$data['buses'] = Bus::all();
		$data['trip'] = $trip;

		return view('tripes.edit')->with($data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		$trip = Trip::where('id', '=', $id)->get()->first();
		$old_bus = $trip->bus_id;
		$old_seats = $trip->avilable_seats;
		$old_source = $trip->source;
		$old_dest = $trip->destination;
		$old_attend = $trip->attend_time;
		$old_start = $trip->trip_start_time;
		$old_price = $trip->price;
		$change = false;

		if($request->input('bus') != $old_bus) {
			//update bus
			$result = DB::table('trips')->where('id', '=', $id)->update(['bus_id' => $request->input('bus')]);
			if($result) {
				$change = true;
			}
			else {
				return back()->with('warning', 'حصل خطأ اثناء العملية');
			}
		}

		if($request->input('seats') != $old_seats) {
			//update seats
			$result = DB::table('trips')->where('id', '=', $id)->update(['avilable_seats' => $request->input('seats')]);
			if($result) {
				$change = true;
			}
			else {
				return back()->with('warning', 'حصل خطأ اثناء العملية');
			}
		}

		if($request->input('source') != $old_source) {
			//update source
			$result = DB::table('trips')->where('id', '=', $id)->update(['source' => $request->input('source')]);
			if($result) {
				$change = true;
			}
			else {
				return back()->with('warning', 'حصل خطأ اثناء العملية');
			}
		}

		if($request->input('destination') != $old_dest) {
			//update destination
			$result = DB::table('trips')->where('id', '=', $id)->update(['destination' => $request->input('destination')]);
			if($result) {
				$change = true;
			}
			else {
				return back()->with('warning', 'حصل خطأ اثناء العملية');
			}
		}

		if($request->input('attend') != $old_attend) {
			//update attend
			$result = DB::table('trips')->where('id', '=', $id)->update(['attend_time' => $request->input('attend')]);
			if($result) {
				$change = true;
			}
			else {
				return back()->with('warning', 'حصل خطأ اثناء العملية');
			}
		}

		if($request->input('start') != $old_start) {
			//update start
			$result = DB::table('trips')->where('id', '=', $id)->update(['trip_start_time' => $request->input('start')]);
			if($result) {
				$change = true;
			}
			else {
				return back()->with('warning', 'حصل خطأ اثناء العملية');
			}
		}

		if($request->input('price') != $old_price) {
			//update price
			$result = DB::table('trips')->where('id', '=', $id)->update(['price' => $request->input('price')]);
			if($result) {
				$change = true;
			}
			else {
				return back()->with('warning', 'حصل خطأ اثناء العملية');
			}
		}

		if($change) {
			return redirect('/panel')->with('success', 'تم تعديل معلومات الرحلة')->withInput(['tab'=>'nav-trip']);
		}
		else {
			return redirect('/panel')->with('info', 'لم تقم بتعديل معلومات الرحلة')->withInput(['tab'=>'nav-trip']);
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
		$result = Trip::where('id', '=', $id)->delete();

		if($result) {
			return redirect('/panel')->with('success', 'تم حذف معلومات الرحلة')->withInput(['tab'=>'nav-trip']);
		}
		else {
			return redirect('/panel')->with('warning', 'حصل خطأ اثناء العملية حاول مرة اخرى')->withInput(['tab'=>'nav-trip']);
		}
	}

}
