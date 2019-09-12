<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reservation;
use App\Trip;
use App\Client;
use DB;

use Illuminate\Http\Request;

class ReservationsApiController extends Controller {

    public function clientReserve(Request $request){
        $input = $request->all();
        $client = new Client();
        $client->name = $input['name'];
        $client->mobile = $input['mobile'];
        $client->location = $input['location'];
        $client->save();

        $reservation = new Reservation();
        $reservation->client_id = $client->id;
        $reservation->trip_id = $input['trip_id'];
        $reservation->booked_seats_num =$input['booked_seats'];
        $reservation->save();

        $trip = DB::table('trips')->find($input['trip_id']);
        if($trip->avilable_seats >= $input['booked_seats']){
            $trip->update(['avilable_seats'=> ($trip->avilable_seats - $input['booked_seats']) ]);
            return response()->json('تم حجر الرحلة ');
        }else
            return response()->json('عدد المقاعد المطلوبة غير متوفر');
     }
   
}
