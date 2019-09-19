<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Exports\ReservationsExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Trip;
use Illuminate\Http\Request;

class MyController extends Controller {
	function reservationExcel()
    {
     	$reservation_data = DB::table('reservations_view')->get();
			$reservation_array[] = array('الاسم', 'الهاتف', 'البداية', 'الوجهة', 'اسم الناقل', 'اسم الباص', 'رقم الحساب', 'طريقة الدفع');
			foreach($reservation_data as $rsv)
			{
				$reservation_array[] = array(
				'الاسم'  => $rsv->client_name,
				'الهاتف'   => $rsv->client_mobile,
				'البداية'    => $rsv->trip_source,
				'الوجهة'  => $rsv->trip_destination,
				'اسم الناقل'   => $rsv->bus_name,
				'اسم الباص'   => $rsv->bus_type,
				'رقم الحساب'   => $rsv->account_num,
				'طريقة الدفع'   => $rsv->pay_type,
				);
			}
			Excel::create('Reservation Data', function($excel) use ($reservation_array){
				$excel->setTitle('Reservation Data');
			$excel->sheet('Reservation Data', function($sheet) use ($reservation_array){
				$sheet->setRightToLeft(true);
				$sheet->getStyle('A2:h2')->getAlignment()->applyFromArray(
					array('horizontal' => 'center')
				);
				$sheet->getStyle('A1:h1')->getFont()->applyFromArray(
					array('bold' => true)
				);
				$sheet->cells('A1:h1', function($cells){
					$cells->setBackground('#dfdfdf');
					$cells->setAlignment('center');
				});
				$sheet->cells('A2:h2', function($cells){
					$cells->setAlignment('right');
				});
				$sheet->fromArray($reservation_array, null, 'A1', false, false);
      });
		 })->download('xlsx');
		 
		 return back();
    }
}
