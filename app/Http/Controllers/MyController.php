<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Exports\ReservationsExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use App\Trip;
use App\Reservation;
use App\DelayedReservation;
use Illuminate\Http\Request;

class MyController extends Controller {
	function reservationExcel()
	{
		$reservation_data = Reservation::all();
		$reservation_array[] = array(
			'الاسم', 
			'الهاتف', 
			'البداية', 
			'الوجهة', 
			'اسم الناقل', 
			'اسم الباص',
			'عدد المقاعد',
			'طريقة الدفع', 
			'رقم الحساب', 
			'الدفع',
			'الوقت'
		);
		foreach($reservation_data as $rsv)
		{
			$reservation_array[] = array(
			'الاسم'  => $rsv->client->name,
			'الهاتف'   => $rsv->client->mobile,
			'البداية'    => $rsv->trip->source,
			'الوجهة'  => $rsv->trip->destination,
			'اسم الناقل'   => $rsv->trip->bus->name,
			'اسم الباص'   => $rsv->trip->bus->type,
			'عدد المقاعد'   => $rsv->booked_seats_num,
			'طريقة الدفع'   => $rsv->pay_type,
			'رقم الحساب'   => $rsv->client->account_num,
			'الدفع'   => $rsv->payed == 0? 'لم يدفع': 'تم الدفع',
			'الوقت'   => date('h:ia', strtotime($rsv->created_at))
			);
		}
		Excel::create('Reservations Data', function($excel) use ($reservation_array){
			$excel->setTitle('Reservations Data');
		$excel->sheet('Reservations Data', function($sheet) use ($reservation_array){
			$sheet->setRightToLeft(true);
			$sheet->getStyle('A2:K1000')->getAlignment()->applyFromArray(
				array('horizontal' => 'center')
			);
			$sheet->getStyle('A1:K1')->getFont()->applyFromArray(
				array('bold' => true)
			);
			$sheet->cells('A1:K1', function($cells){
				$cells->setBackground('#dfdfdf');
				$cells->setAlignment('center');
			});
			$sheet->cells('A2:K1000', function($cells){
				$cells->setAlignment('right');
			});
			$sheet->fromArray($reservation_array, null, 'A1', false, false);
		});
		})->download('xlsx');
		
		return back()->withInput(['tab'=>'nav-reservation']);;
	}

	/**
	 *  Funtion to export trips into excel
	 */
	function tripExcel()
	{
		$trip_data = Trip::all();
		$trip_array[] = array(
			'البداية', 
			'الوجهة',
			'الحضور',
			'الانطلاق', 
			'اسم الناقل', 
			'اسم الباص',
			'عدد المقاعد',
			'التذكرة'
		);
		foreach($trip_data as $trp)
		{
			$trip_array[] = array(
				'البداية'    			=> $trp->source,
				'الوجهة'  				=> $trp->destination,
				'الحضور'  				=> date('h:ia', strtotime($trp->attend_time)),
				'الانطلاق'  				=> date('h:ia', strtotime($trp->trip_start_time)),
				'اسم الناقل'   		=> $trp->bus->name,
				'اسم الباص'   		=> $trp->bus->type,
				'عدد المقاعد'   	=> $trp->avilable_seats,
				'التذكرة'   			=> $trp->price
			);
		}
		Excel::create('Trips Data', function($excel) use ($trip_array){
			$excel->setTitle('Trips Data');
		$excel->sheet('Trips Data', function($sheet) use ($trip_array){
			$sheet->setRightToLeft(true);
			$sheet->getStyle('A2:H1000')->getAlignment()->applyFromArray(
				array('horizontal' => 'center')
			);
			$sheet->getStyle('A1:H1')->getFont()->applyFromArray(
				array('bold' => true)
			);
			$sheet->cells('A1:H1', function($cells){
				$cells->setBackground('#dfdfdf');
				$cells->setAlignment('center');
			});
			$sheet->cells('A2:H1000', function($cells){
				$cells->setAlignment('right');
			});
			$sheet->fromArray($trip_array, null, 'A1', false, false);
		});
		})->download('xlsx');
		
		return back()->withInput(['tab'=>'nav-trip']);;
	}

	function delayedExcel()
	{
		$reservation_data = DelayedReservation::all();
		$reservation_array[] = array(
			'الاسم', 
			'الهاتف', 
			'البداية', 
			'الوجهة',
			'عدد المقاعد',
			'التاريخ'
		);
		foreach($reservation_data as $rsv)
		{
			$reservation_array[] = array(
			'الاسم'  => $rsv->client->name,
			'الهاتف'   => $rsv->client->mobile,
			'البداية'    => $rsv->staticTrip->source,
			'الوجهة'  => $rsv->staticTrip->destination,
			'عدد المقاعد'   => $rsv->booked_seats_num,
			'التاريخ'   => date('M d, Y', strtotime($rsv->reserve_date))
			);
		}
		Excel::create('Delayed Reservations Data', function($excel) use ($reservation_array){
			$excel->setTitle('Delayed Reservations Data');
		$excel->sheet('Delayed Reservations Data', function($sheet) use ($reservation_array){
			$sheet->setRightToLeft(true);
			$sheet->getStyle('A2:F1000')->getAlignment()->applyFromArray(
				array('horizontal' => 'center')
			);
			$sheet->getStyle('A1:F1')->getFont()->applyFromArray(
				array('bold' => true)
			);
			$sheet->cells('A1:F1', function($cells){
				$cells->setBackground('#dfdfdf');
				$cells->setAlignment('center');
			});
			$sheet->cells('A2:F1000', function($cells){
				$cells->setAlignment('right');
			});
			$sheet->fromArray($reservation_array, null, 'A1', false, false);
		});
		})->download('xlsx');
		
		return back()->withInput(['tab'=>'nav-delayed']);;
	}
}
