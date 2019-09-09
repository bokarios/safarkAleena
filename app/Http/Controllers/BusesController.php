<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bus;

use Illuminate\Http\Request;

class BusesController extends Controller {

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
	public function store(Request $request)
	{
		$output = '';

		if($request->input('name') == '') {
			$output .= '
				<p class="alert alert-warning text-center">
					ادخل اسم الباص اولا
				</p>
			';
		}
		if($request->input('type') == '') {
			$output .= '
				<p class="alert alert-warning text-center">
					ادخل نوع الباص اولا
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

		if($request->input('name') != '' && $request->input('type') != '' && $request->input('seats') != '') {
			$bus = new Bus();
			$bus->name = $request->input('name');
			$bus->type = $request->input('type');
			$bus->seats_num = $request->input('seats');
			$result = $bus->save();

			if($result) {
				$output .= '
				<p class="alert alert-success text-center">
					تمت اضافة الباص بنجاح
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Requests $request, $id)
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
