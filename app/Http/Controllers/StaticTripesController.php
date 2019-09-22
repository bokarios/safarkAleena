<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\StaticTrip;
use Illuminate\Http\Request;

class StaticTripesController extends Controller {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$output = '';

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

		if( 
			$request->input('source') != '' && 
			$request->input('destination') != ''
		) 
		{
			$trip = new StaticTrip();
			$trip->source = $request->input('source');
			$trip->destination = $request->input('destination');
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
