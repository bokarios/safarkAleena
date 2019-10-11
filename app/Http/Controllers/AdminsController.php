<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reservation;
use App\DelayedReservation;
use App\Trip;
use App\Bus;
use App\User;
use App\StaticTrip;
use App\Comment;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Admin data
		$data['admin'] = Auth::user();

		//Reservations
		$data['reservations'] = Reservation::all();
		
		//Trips
		$data['trips'] = Trip::where('avilable_seats', '>', 0)->get();

		//Static
		$data['static_trips'] = StaticTrip::all();

		// Delayed Reservations
		$data['delayed'] = DelayedReservation::all();

		//Comments
		$data['comments'] = Comment::all();

		//Buses
		$data['buses'] = Bus::orderBy('name', 'asc')->get();
		
		return view('admins.index')->with($data);
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
		if($request->input('access') == '') {
			$output .= '
				<p class="alert alert-warning text-center">
					حدد صلاحية الوصول اولا
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
			$request->input('access') != '' &&
			$request->input('password') == $request->input('password2')
		) 
		{
			$user = new User();
			$user->name = $request->input('name');
			$user->email = $request->input('email');
			$user->access = $request->input('access');
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
	 * Refresh the reservations table data.
	 * 
	 * @return Response
	 */
	public function reservationsRefresh(Request $request)
	{
		$reservations = Reservation::all();

		$data = '';

		$data .= '
			<table class="table table-striped table-bordered table-hover direction-rtl">
				<thead class="thead-light">
					<tr>
						<th class="text-center">الإسم</th>
						<th class="text-center">الهاتف</th>
						<th class="text-center">البداية</th>
						<th class="text-center">الوجهة</th>
						<th class="text-center">اسم الناقل</th>
						<th class="text-center">اسم الباص</th>
						<th class="text-center">عدد المقاعد</th>
						<th class="text-center">طريقة الدفع</th>
						<th class="text-center">رقم الحساب</th>
						<th class="text-center">الدفع</th>
						<th class="text-center">الوقت</th>
					</tr>
				</thead>
				<tbody>
		';
		foreach($reservations as $resv)
		{
			$data .= '<tr>';
			$data .= '<td class="text-center">'.$resv->client->name.'</td>';
			$data .= '<td class="text-center">'.$resv->client->mobile.'</td>';
			$data .= '<td class="text-center">'.$resv->trip->source.'</td>';
			$data .= '<td class="text-center">'.$resv->trip->destination.'</td>';
			$data .= '<td class="text-center">'.$resv->trip->bus->name.'</td>';
			$data .= '<td class="text-center">'.$resv->trip->bus->type.'</td>';
			$data .= '<td class="text-center">'.$resv->booked_seats_num.'</td>';
			$data .= '<td class="text-center">'.$resv->pay_type.'</td>';
			$data .= '<td class="text-center">'.$resv->client->account_num.'</td>';
			$data .= '<td class="text-center">';
			$data .=	$resv->payed == 1? '<i class="fas fa-check-circle text-success"></i>':'<i class="fas fa-times-circle text-danger"></i>';
			$data .= '</td>';
			$data .= '<td class="text-center">'.  date("h:ia",strtotime($resv->created_at)) .'</td>';
			$data .= Auth::user()->access == 0? '<td class="text-center">
				<a href="reservations/'. $resv->id .'/edit">
					<i class="fas fa-edit text-primary mr-2"></i>
				</a>  
				<a href="reservations/'. $resv->id .'/delete">
					<i class="fas fa-trash text-danger mr-2"></i>
				</a> 
			</td>': '';
		$data .= '</tr>';
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
		$result = Reservation::where('booked_seats_num', 'LIKE', '%'.$search.'%')
			->orWhere('pay_type', 'LIKE', '%'.$search.'%')
			->orWhereHas('client', function($query) use ($search){
				return $query->where('name', 'LIKE', '%'.$search.'%')
					->orWhere('account_num', 'LIKE', '%'.$search.'%')
					->orWhere('mobile', 'LIKE', '%'.$search.'%');
			})
			->orWhereHas('trip', function($query) use ($search){
				return $query->where('source', 'LIKE', '%'.$search.'%')
					->orWhere('destination', 'LIKE', '%'.$search.'%')
					->orWhereHas('bus', function($query) use ($search){
						return $query->where('type', 'LIKE', '%'.$search.'%')
							->orWhere('name', 'LIKE', '%'.$search.'%');
										});
			})
		->get();

		$data = '';

		if(count($result) != 0)
		{
			$data .= '
			<table class="table table-striped table-bordered table-hover direction-rtl">
				<thead class="thead-light">
					<tr>
						<th class="text-center">الإسم</th>
						<th class="text-center">الهاتف</th>
						<th class="text-center">البداية</th>
						<th class="text-center">الوجهة</th>
						<th class="text-center">اسم الناقل</th>
						<th class="text-center">اسم الباص</th>
						<th class="text-center">عدد المقاعد</th>
						<th class="text-center">طريقة الدفع</th>
						<th class="text-center">رقم الحساب</th>
						<th class="text-center">الدفع</th>
						<th class="text-center">الوقت</th>
					</tr>
				</thead>
				<tbody>
			';
			foreach($result as $resv)
			{
				$data .= '<tr>';
				$data .= '<td class="text-center">'.$resv->client->name.'</td>';
				$data .= '<td class="text-center">'.$resv->client->mobile.'</td>';
				$data .= '<td class="text-center">'.$resv->trip->source.'</td>';
				$data .= '<td class="text-center">'.$resv->trip->destination.'</td>';
				$data .= '<td class="text-center">'.$resv->trip->bus->name.'</td>';
				$data .= '<td class="text-center">'.$resv->trip->bus->type.'</td>';
				$data .= '<td class="text-center">'.$resv->booked_seats_num.'</td>';
				$data .= '<td class="text-center">'.$resv->pay_type.'</td>';
				$data .= '<td class="text-center">'.$resv->client->account_num.'</td>';
				$data .= '<td class="text-center">';
				$data .=	$resv->payed == 1? '<i class="fas fa-check-circle text-success"></i>':'<i class="fas fa-times-circle text-danger"></i>';
				$data .= '</td>';
				$data .= '<td class="text-center">'.  date("h:ia",strtotime($resv->created_at)) .'</td>';
				$data .= Auth::user()->access == 0? '<td class="text-center">
					<a href="reservations/'. $resv->id .'/edit">
						<i class="fas fa-edit text-primary mr-2"></i>
					</a>  
					<a href="reservations/'. $resv->id .'/delete">
						<i class="fas fa-trash text-danger mr-2"></i>
					</a> 
				</td>': '';
			$data .= '</tr>';
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
		$reservations = DelayedReservation::all();

		$data = '';

		$data .= '
			<table class="table table-striped table-bordered table-hover direction-rtl">
				<thead class="thead-light">
					<tr>
						<th class="text-center">الإسم</th>
						<th class="text-center">الهاتف</th>
						<th class="text-center">البداية</th>
						<th class="text-center">الوجهة</th>
						<th class="text-center">التاريخ</th>
						<th class="text-center">عدد المقاعد</th>
					</tr>
				</thead>
				<tbody>
		';
		foreach($reservations as $resv)
		{
			$data .= '<tr>';
			$data .= '<td class="text-center">'.$resv->client->name.'</td>';
			$data .= '<td class="text-center">'.$resv->client->mobile.'</td>';
			$data .= '<td class="text-center">'.$resv->staticTrip->source.'</td>';
			$data .= '<td class="text-center">'.$resv->staticTrip->destination.'</td>';
			$data .= '<td class="text-center">'.  date("M d, Y",strtotime($resv->created_at)) .'</td>';
			$data .= '<td class="text-center">'.$resv->booked_seats_num.'</td>';
			$data .= Auth::user()->access == 0? '<td class="text-center">
				<a href="reservations/'. $resv->id .'/edit">
					<i class="fas fa-edit text-primary mr-2"></i>
				</a>  
				<a href="reservations/'. $resv->id .'/delete">
					<i class="fas fa-trash text-danger mr-2"></i>
				</a> 
			</td>': '';
		$data .= '</tr>';
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
		$result = DelayedReservation::where('booked_seats_num', 'LIKE', '%'.$search.'%')
			->orWhereHas('client', function($query) use ($search){
				return $query->where('name', 'LIKE', '%'.$search.'%')
					->orWhere('mobile', 'LIKE', '%'.$search.'%');
			})
			->orWhereHas('staticTrip', function($query) use ($search){
				return $query->where('source', 'LIKE', '%'.$search.'%')
					->orWhere('destination', 'LIKE', '%'.$search.'%');
			})
		->get();

		$data = '';

		if(count($result) != 0)
		{
			$data .= '
				<table class="table table-striped table-bordered table-hover direction-rtl">
					<thead class="thead-light">
						<tr>
							<th class="text-center">الإسم</th>
							<th class="text-center">الهاتف</th>
							<th class="text-center">البداية</th>
							<th class="text-center">الوجهة</th>
							<th class="text-center">التاريخ</th>
							<th class="text-center">عدد المقاعد</th>
						</tr>
					</thead>
					<tbody>
			';
			foreach($result as $resv)
			{
				$data .= '<tr>';
				$data .= '<td class="text-center">'.$resv->client->name.'</td>';
				$data .= '<td class="text-center">'.$resv->client->mobile.'</td>';
				$data .= '<td class="text-center">'.$resv->staticTrip->source.'</td>';
				$data .= '<td class="text-center">'.$resv->staticTrip->destination.'</td>';
				$data .= '<td class="text-center">'.  date("M d, Y",strtotime($resv->created_at)) .'</td>';
				$data .= '<td class="text-center">'.$resv->booked_seats_num.'</td>';
				$data .= Auth::user()->access == 0? '<td class="text-center">
					<a href="reservations/'. $resv->id .'/edit">
						<i class="fas fa-edit text-primary mr-2"></i>
					</a>  
					<a href="reservations/'. $resv->id .'/delete">
						<i class="fas fa-trash text-danger mr-2"></i>
					</a> 
				</td>': '';
				$data .= '</tr>';
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
		$trips = Trip::all();

		$data = '';

		$data .= '
		<table class="table table-striped table-bordered hover direction-rtl">
		<thead>
			<tr>
				<th class="text-center">البداية</th>
				<th class="text-center">الوجهة</th>
				<th class="text-center">الحضور</th>
				<th class="text-center">الانطلاق</th>
				<th class="text-center">اسم الناقل</th>
				<th class="text-center">اسم الباص</th>
				<th class="text-center">عدد المقاعد</th>
				<th class="text-center">التذكرة</th>
			</tr>
		</thead>
		<tbody>
		';
		foreach($trips as $trip)
		{
			$data .= '<tr>';
			$data .= '<td class="text-center">'.$trip->source.'</td>';
			$data .= '<td class="text-center">'.$trip->destination.'</td>';
			$data .= '<td class="text-center">'.  date("h:ia",strtotime($trip->attend_time)) .'</td>';
			$data .= '<td class="text-center">'.  date("h:ia",strtotime($trip->trip_start_time)) .'</td>';
			$data .= '<td class="text-center">'.$trip->bus->name.'</td>';
			$data .= '<td class="text-center">'.$trip->bus->type.'</td>';
			$data .= '<td class="text-center">'.$trip->avilable_seats.'</td>';
			$data .= '<td class="text-center">'.$trip->price.'</td>';
			$data .= Auth::user()->access == 0? '<td class="text-center">
				<a href="tripes/'. $trip->id .'/edit">
					<i class="fas fa-edit text-primary mr-2"></i>
				</a>  
				<a href="tripes/'. $trip->id .'/delete">
					<i class="fas fa-trash text-danger mr-2"></i>
				</a> 
			</td>': '';
		$data .= '</tr>';
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
		$result = Trip::where('source', 'LIKE', '%'.$search.'%')
			->orWhere('destination', 'LIKE', '%'.$search.'%')
			->orWhere('avilable_seats', 'LIKE', '%'.$search.'%')
			->orWhere('price', 'LIKE', '%'.$search.'%')
			->orWhereHas('bus', function($query) use ($search){
				return $query->where('type', 'LIKE', '%'.$search.'%')
				->orWhere('name', 'LIKE', '%'.$search.'%');
			})
		->get();

		$data = '';

		if(count($result) != 0)
		{
			$data .= '
				<table class="table table-striped table-bordered hover direction-rtl">
					<thead>
						<tr>
							<th class="text-center">البداية</th>
							<th class="text-center">الوجهة</th>
							<th class="text-center">الحضور</th>
							<th class="text-center">الانطلاق</th>
							<th class="text-center">اسم الناقل</th>
							<th class="text-center">اسم الباص</th>
							<th class="text-center">عدد المقاعد</th>
							<th class="text-center">التذكرة</th>
						</tr>
					</thead>
					<tbody>
			';
			foreach($result as $trip)
			{
				$data .= '<tr>';
				$data .= '<td class="text-center">'.$trip->source.'</td>';
				$data .= '<td class="text-center">'.$trip->destination.'</td>';
				$data .= '<td class="text-center">'.date("h:ia",strtotime($trip->attend)).'</td>';
				$data .= '<td class="text-center">'.date("h:ia",strtotime($trip->start)).'</td>';
				$data .= '<td class="text-center">'.$trip->bus->name.'</td>';
				$data .= '<td class="text-center">'.$trip->bus->type.'</td>';
				$data .= '<td class="text-center">'.$trip->avilable_seats.'</td>';
				$data .= '<td class="text-center">'.$trip->price.'</td>';
				$data .= Auth::user()->access == 0?'<td class="text-center">
					<a href="tripes/'. $trip->id .'/edit">
						<i class="fas fa-edit text-primary mr-2"></i>
					</a>  
					<a href="tripes/'. $trip->id .'/delete">
						<i class="fas fa-trash text-danger mr-2"></i>
					</a> 
				</td>':'';
			$data .= '</tr>';
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

	/**
	 * Truncate the reservations table data.
	 * 
	 * @return Response
	 */
	public function reservationsTruncate()
	{
		$result = DB::table('reservations')->delete();

		if($result)
		{
			return back()->with('success', 'تم مسح جميع معلومات الحجوزات')->withInput(['tab'=>'nav-reservation']);
		}
		else {
			return back()->with('warning', 'حصل خطأ اثناء العملية')->withInput(['tab'=>'nav-reservation']);
		}
	}

	/**
	 * Truncate the delayed reservations table data.
	 * 
	 * @return Response
	 */
	public function delayedTruncate()
	{
		$result = DB::table('delayed_reservations')->delete();

		if($result)
		{
			return back()->with('success', 'تم مسح جميع معلومات الحجوزات المؤجلة')->withInput(['tab'=>'nav-delayed']);
		}
		else {
			return back()->with('warning', 'حصل خطأ اثناء العملية')->withInput(['tab'=>'nav-delayed']);
		}
	}

	/**
	 * Truncate the static trips table data.
	 * 
	 * @return Response
	 */
	public function staticTripesTruncate()
	{
		$result = DB::table('static_trips')->delete();

		if($result)
		{
			return back()->with('success', 'تم مسح جميع معلومات الرحلات الافتراضية')->withInput(['tab'=>'nav-static']);
		}
		else {
			return back()->with('warning', 'حصل خطأ اثناء العملية')->withInput(['tab'=>'nav-static']);
		}
	}

}
