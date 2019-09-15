<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reservation;
use App\Trip;
use App\Bus;
use App\User;
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
		$data['reservations'] = DB::table('reservations_view')->get();
		
		//Trips view query
		$data['trips'] = DB::table('trips_view')->get();

		//Static trips view query
		$data['static_trips'] = DB::table('static_trips')->get();

		// Delayed Reservations view query
		$data['delayed'] = DB::table('delayed_reservations_view')->get();

		//Buses
		$data['buses'] = Bus::orderBy('name', 'asc');
		
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
	public function store(Request $request)
	{
		$output = '';

		if($request->input('name') == '') {
			$output .= '
				<p class="alert alert-warning text-center">
					ادخل اسم المدير اولا
				</p>
			';
		}
		if($request->input('email') == '') {
			$output .= '
				<p class="alert alert-warning text-center">
					ادخل البريد الالكتروني اولا
				</p>
			';
		}
		if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix" , $request->input('email'))) {
			$output .= '
				<p class="alert alert-warning text-center">
					ادخل بريد الكتروني صحيح
				</p>
			';
		}
		if($request->input('password') == '') {
			$output .= '
				<p class="alert alert-warning text-center">
					ادخل كلمة المرور اولا
				</p>
			';
		}
		if($request->input('password2') == '') {
			$output .= '
				<p class="alert alert-warning text-center">
					ادخل تأكيد كلمة المرور اولا
				</p>
			';
		}
		if($request->input('password') != $request->input('password2')) {
			$output .= '
				<p class="alert alert-warning text-center">
					كلمة المرور و تأكيد كلمة المرور مختلفان
				</p>
			';
		}

		if(
			$request->input('name') != '' &&
			$request->input('email') != '' &&
			$request->input('password') != '' &&
			$request->input('password2') != '' &&
			$request->input('password') == $request->input('password2')
		) 
		{
			$user = new User();
			$user->name = $request->input('name');
			$user->email = $request->input('email');
			$user->password = bcrypt($request->input('password'));
			$user->remember_token = $request->input('_token');
			$result = $user->save();

			if($result) {
				$output .= '
				<p class="alert alert-success text-center">
					تمت اضافة المدير بنجاح
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

	/**
	 * Refresh the reservations table data.
	 * 
	 * @return Response
	 */
	public function reservationsRefresh(Request $request)
	{
		$reservations = DB::table('reservations_view')->get();

		$data = '';
		$i = 1;

		$data .= '
			<table class="table table-striped table-bordered table-hover direction-rtl">
				<thead class="thead-light">
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">الإسم</th>
						<th class="text-center">البداية</th>
						<th class="text-center">الوجهة</th>
						<th class="text-center">نوع الباص</th>
						<th class="text-center">عدد المقاعد</th>
						<th class="text-center">الدفع</th>
						<th class="text-center">التاريخ</th>
					</tr>
				</thead>
				<tbody class="tbl-btn-p" id="tbl-row" ondblclick="document.getElementById(\'tbl-row\').classList.add(\'active\');" onclick="document.getElementById(\'tbl-row\').classList.remove(\'active\')">
		';
		foreach($reservations as $resv)
		{
			$data .= '<tr>';
			$data .= '<td class="text-center">'.$i.'</td>';
			$data .= '<td class="text-center">'.$resv->client_name.'</td>';
			$data .= '<td class="text-center">'.$resv->trip_source.'</td>';
			$data .= '<td class="text-center">'.$resv->trip_destination.'</td>';
			$data .= '<td class="text-center">'.$resv->bus_type.'</td>';
			$data .= '<td class="text-center">'.$resv->booked_seats.'</td>';
			$data .= '<td class="text-center">';
			$data .=	$resv->payed == 1? '<i class="fas fa-check-circle text-success"></i>':'<i class="fas fa-times-circle text-danger"></i>';
			$data .= '</td>';
			$data .= '<td class="text-center">'.  date("M d (h:ia)",strtotime($resv->created_at)) .'</td>';
			$data .= '<td class="text-center tbl-btn animated slideInLeft px-1">
				<a href="reservations/'. $resv->id .'/edit">
					<i class="fas fa-edit text-primary mr-2"></i>
				</a>  
				<a href="reservations/'. $resv->id .'/delete">
					<i class="fas fa-trash text-danger mr-2"></i>
				</a> 
			</td>';
		$data .= '</tr>';
		$i++;
		}
		$data .= '
				</tbody>
			</table>
		';

		echo $data;
	}

	/**
	 * Search the reservations table data.
	 * 
	 * @return Response
	 */
	public function reservationsSearch(Request $request)
	{
		$search = $request->input('query');
		$reservations = DB::table('reservations_view')
			->where('client_name', 'LIKE', '%'.$search.'%')
			->orWhere('trip_source', 'LIKE', '%'.$search.'%')
			->orWhere('trip_destination', 'LIKE', '%'.$search.'%')
			->orWhere('booked_seats', 'LIKE', '%'.$search.'%')
			->orWhere('bus_type', 'LIKE', '%'.$search.'%')
			->get();
		$data = '';
		$i = 1;

		if(!empty($reservations))
		{
			$data .= '
			<table class="table table-striped table-bordered table-hover direction-rtl">
				<thead class="thead-light">
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">الإسم</th>
						<th class="text-center">البداية</th>
						<th class="text-center">الوجهة</th>
						<th class="text-center">نوع الباص</th>
						<th class="text-center">عدد المقاعد</th>
						<th class="text-center">الدفع</th>
						<th class="text-center">التاريخ</th>
					</tr>
				</thead>
				<tbody class="tbl-btn-p" id="tbl-row" ondblclick="document.getElementById(\'tbl-row\').classList.add(\'active\');" onclick="document.getElementById(\'tbl-row\').classList.remove(\'active\')">
			';
			foreach($reservations as $resv)
			{
				$data .= '<tr>';
				$data .= '<td class="text-center">'.$i.'</td>';
				$data .= '<td class="text-center">'.$resv->client_name.'</td>';
				$data .= '<td class="text-center">'.$resv->trip_source.'</td>';
				$data .= '<td class="text-center">'.$resv->trip_destination.'</td>';
				$data .= '<td class="text-center">'.$resv->bus_type.'</td>';
				$data .= '<td class="text-center">'.$resv->booked_seats.'</td>';
				$data .= '<td class="text-center">';
				$data .=	$resv->payed == 1? '<i class="fas fa-check-circle text-success"></i>':'<i class="fas fa-times-circle text-danger"></i>';
				$data .= '</td>';
				$data .= '<td class="text-center">'.  date("M d (h:ia)",strtotime($resv->created_at)) .'</td>';
				$data .= '<td class="text-center tbl-btn animated slideInLeft px-1">
					<a href="reservations/'. $resv->id .'/edit">
						<i class="fas fa-edit text-primary mr-2"></i>
					</a>  
					<a href="reservations/'. $resv->id .'/delete">
						<i class="fas fa-trash text-danger mr-2"></i>
					</a> 
				</td>';
			$data .= '</tr>';
			$i++;
			}
			$data .= '
					</tbody>
				</table>
			';
		}
		else
		{
			$data .= '
			
					<div class="text-center mt-5">
						<i class="fa fa-ban text-warning fa-2x text-center"></i>
						<h2 class="text-center text-warning">لا يوجد نتائج توافق بحثك</h2>
					</div>

			';
		}

		echo $data;
	}

	/**
	 * Refresh the delayed reservations table data.
	 * 
	 * @return Response
	 */
	public function delayedRefresh(Request $request)
	{
		$query = "
			SELECT
				rsv.id AS id,
				cl.name AS client_name,
				cl.mobile AS client_mobile,
				cl.location AS client_location,
				trp.source AS trip_source,
				trp.destination AS trip_destination,
				rsv.booked_seats_num AS booked_seats,
				rsv.reserve_date AS date,
				rsv.created_at AS created_at,
				rsv.updated_at AS updated_at
			FROM
				delayed_reservations AS rsv,
				static_trips AS trp,
				clients AS cl
			WHERE
				rsv.client_id = cl.id AND
				rsv.static_trip_id = trp.id
		";
		$reservations = DB::select($query);

		$data = '';
		$i = 1;

		$data .= '
			<table class="table table-striped table-bordered table-hover direction-rtl">
				<thead class="thead-light">
					<tr>
						<th class="text-center">#</th>
						<th class="text-center">الإسم</th>
						<th class="text-center">البداية</th>
						<th class="text-center">الوجهة</th>
						<th class="text-center">التاريخ</th>
						<th class="text-center">عدد المقاعد</th>
					</tr>
				</thead>
				<tbody class="tbl-btn-p" id="tbl-row-d" ondblclick="document.getElementById(\'tbl-row-d\').classList.add(\'active\');" onclick="document.getElementById(\'tbl-row-d\').classList.remove(\'active\')">
		';
		foreach($reservations as $resv)
		{
			$data .= '<tr>';
			$data .= '<td class="text-center">'.$i.'</td>';
			$data .= '<td class="text-center">'.$resv->client_name.'</td>';
			$data .= '<td class="text-center">'.$resv->trip_source.'</td>';
			$data .= '<td class="text-center">'.$resv->trip_destination.'</td>';
			$data .= '<td class="text-center">'.  date("M d, Y",strtotime($resv->created_at)) .'</td>';
			$data .= '<td class="text-center">'.$resv->booked_seats.'</td>';
			$data .= '<td class="text-center tbl-btn animated slideInLeft">
				<a href="reservations/'. $resv->id .'/edit">
					<i class="fas fa-edit text-primary mr-2"></i>
				</a>  
				<a href="reservations/'. $resv->id .'/delete">
					<i class="fas fa-trash text-danger mr-2"></i>
				</a> 
			</td>';
		$data .= '</tr>';
		$i++;
		}
		$data .= '
				</tbody>
			</table>
		';

		echo $data;
	}

	/**
	 * Search the delayed reservations table data.
	 * 
	 * @return Response
	 */
	public function delayedSearch(Request $request)
	{
		$search = $request->input('query');
		$query = "
			SELECT
				rsv.id AS id,
				cl.name AS client_name,
				cl.mobile AS client_mobile,
				cl.location AS client_location,
				trp.source AS trip_source,
				trp.destination AS trip_destination,
				rsv.booked_seats_num AS booked_seats,
				rsv.reserve_date AS date,
				rsv.created_at AS created_at,
				rsv.updated_at AS updated_at
			FROM
				delayed_reservations AS rsv,
				static_trips AS trp,
				clients AS cl
			WHERE
				rsv.client_id = cl.id AND
				rsv.static_trip_id = trp.id
		";
		$reservations = DB::table('delayed_reservations_view')
			->where('client_name', 'LIKE', '%'.$search.'%')
			->orWhere('trip_source', 'LIKE', '%'.$search.'%')
			->orWhere('trip_destination', 'LIKE', '%'.$search.'%')
			->orWhere('booked_seats', 'LIKE', '%'.$search.'%')
			->get()
			;
		$data = '';
		$i = 1;

		if(!empty($reservations))
		{
			$data .= '
				<table class="table table-striped table-bordered table-hover direction-rtl">
					<thead class="thead-light">
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">الإسم</th>
							<th class="text-center">البداية</th>
							<th class="text-center">الوجهة</th>
							<th class="text-center">التاريخ</th>
							<th class="text-center">عدد المقاعد</th>
						</tr>
					</thead>
					<tbody class="tbl-btn-p" id="tbl-row-d" ondblclick="document.getElementById(\'tbl-row-d\').classList.add(\'active\');" onclick="document.getElementById(\'tbl-row-d\').classList.remove(\'active\')">
			';
			foreach($reservations as $resv)
			{
				$data .= '<tr>';
				$data .= '<td class="text-center">'.$i.'</td>';
				$data .= '<td class="text-center">'.$resv->client_name.'</td>';
				$data .= '<td class="text-center">'.$resv->trip_source.'</td>';
				$data .= '<td class="text-center">'.$resv->trip_destination.'</td>';
				$data .= '<td class="text-center">'.  date("M d, Y",strtotime($resv->created_at)) .'</td>';
				$data .= '<td class="text-center">'.$resv->booked_seats.'</td>';
				$data .= '<td class="text-center tbl-btn animated slideInLeft px-1">
					<a href="reservations/'. $resv->id .'/edit">
						<i class="fas fa-edit text-primary mr-2"></i>
					</a>  
					<a href="reservations/'. $resv->id .'/delete">
						<i class="fas fa-trash text-danger mr-2"></i>
					</a> 
				</td>';
				$data .= '</tr>';
				$i++;
			}
			$data .= '
					</tbody>
				</table>
			';
		}
		else
		{
			$data .= '
			
					<div class="text-center mt-5">
						<i class="fa fa-ban text-warning fa-2x text-center"></i>
						<h2 class="text-center text-warning">لا يوجد نتائج توافق بحثك</h2>
					</div>

			';
		}

		echo $data;
	}

	/**
	 * Refresh the Tripes table data.
	 * 
	 * @return Response
	 */
	public function tripesRefresh(Request $request)
	{
		$trips = DB::table('trips_view')->get();

		$data = '';
		$i = 1;

		$data .= '
		<table class="table table-striped table-bordered hover direction-rtl">
		<thead>
			<tr>
				<th class="text-center">#</th>
				<th class="text-center">البداية</th>
				<th class="text-center">الوجهة</th>
				<th class="text-center">الحضور</th>
				<th class="text-center">الانطلاق</th>
				<th class="text-center">نوع الباص</th>
				<th class="text-center">عدد المقاعد</th>
				<th class="text-center tbl-btn-p">التذكرة</th>
			</tr>
		</thead>
		<tbody class="tbl-btn-p" id="tbl-row-t" ondblclick="document.getElementById(\'tbl-row-t\').classList.add(\'active\');" onclick="document.getElementById(\'tbl-row-t\').classList.remove(\'active\')">
		';
		foreach($trips as $trip)
		{
			$data .= '<tr>';
			$data .= '<td class="text-center">'.$i.'</td>';
			$data .= '<td class="text-center">'.$trip->source.'</td>';
			$data .= '<td class="text-center">'.$trip->destination.'</td>';
			$data .= '<td class="text-center">'.  date("h:ia",strtotime($trip->attend)) .'</td>';
			$data .= '<td class="text-center">'.  date("h:ia",strtotime($trip->start)) .'</td>';
			$data .= '<td class="text-center">'.$trip->bus_type.'</td>';
			$data .= '<td class="text-center">'.$trip->seats.'</td>';
			$data .= '<td class="text-center">'.$trip->price.'</td>';
			$data .= '<td class="text-center tbl-btn animated slideInLeft">
				<a href="tripes/'. $trip->id .'/edit">
					<i class="fas fa-edit text-primary mr-2"></i>
				</a>  
				<a href="tripes/'. $trip->id .'/delete">
					<i class="fas fa-trash text-danger mr-2"></i>
				</a> 
			</td>';
		$data .= '</tr>';
		$i++;
		}
		$data .= '
				</tbody>
			</table>
		';

		echo $data;
	}

	/**
	 * Search the tripes table data.
	 * 
	 * @return Response
	 */
	public function tripesSearch(Request $request)
	{
		$search = $request->input('query');
		$trips = DB::table('trips_view')
			->where('price', 'LIKE', '%'.$search.'%')
			->orWhere('source', 'LIKE', '%'.$search.'%')
			->orWhere('destination', 'LIKE', '%'.$search.'%')
			->orWhere('seats', 'LIKE', '%'.$search.'%')
			->orWhere('bus_type', 'LIKE', '%'.$search.'%')
			->get();
		$data = '';
		$i = 1;

		if(!empty($trips))
		{
			$data .= '
				<table class="table table-striped table-bordered hover direction-rtl">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">البداية</th>
							<th class="text-center">الوجهة</th>
							<th class="text-center">الحضور</th>
							<th class="text-center">الانطلاق</th>
							<th class="text-center">نوع الباص</th>
							<th class="text-center">عدد المقاعد</th>
							<th class="text-center tbl-btn-p">التذكرة</th>
						</tr>
					</thead>
					<tbody class="tbl-btn-p" id="tbl-row-t" ondblclick="document.getElementById(\'tbl-row-t\').classList.add(\'active\');" onclick="document.getElementById(\'tbl-row-t\').classList.remove(\'active\')">
			';
			foreach($trips as $trip)
			{
				$data .= '<tr>';
				$data .= '<td class="text-center">'.$i.'</td>';
				$data .= '<td class="text-center">'.$trip->source.'</td>';
				$data .= '<td class="text-center">'.$trip->destination.'</td>';
				$data .= '<td class="text-center">'.date("h:ia",strtotime($trip->attend)).'</td>';
				$data .= '<td class="text-center">'.date("h:ia",strtotime($trip->start)).'</td>';
				$data .= '<td class="text-center">'.$trip->bus_type.'</td>';
				$data .= '<td class="text-center">'.$trip->seats.'</td>';
				$data .= '<td class="text-center">'.$trip->price.'</td>';
				$data .= '<td class="text-center tbl-btn animated slideInLeft">
					<a href="tripes/'. $trip->id .'/edit">
						<i class="fas fa-edit text-primary mr-2"></i>
					</a>  
					<a href="tripes/'. $trip->id .'/delete">
						<i class="fas fa-trash text-danger mr-2"></i>
					</a> 
				</td>';
			$data .= '</tr>';
			$i++;
			}
			$data .= '
					</tbody>
				</table>
			';
		}
		else
		{
			$data .= '
			
					<div class="text-center mt-5">
						<i class="fa fa-ban text-warning fa-2x text-center"></i>
						<h2 class="text-center text-warning">لا يوجد نتائج توافق بحثك</h2>
					</div>

			';
		}

		echo $data;
	}

	/**
	 * Truncate the tripes table data.
	 * 
	 * @return Response
	 */
	public function tripesTruncate()
	{
		$result = DB::table('trips')->delete();

		if($result)
		{
			return back()->with('success', 'تم مسح جميع معلومات الرحلات')->withInput(['tab'=>'nav-trip']);
		}
		else {
			return back()->with('warning', 'حصل خطأ اثناء العملية')->withInput(['tab'=>'nav-trip']);
		}
	}

}
