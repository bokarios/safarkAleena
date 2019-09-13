<?php 
namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Reservation;
use App\DelayedReservation;
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
        $client->save();

        $reservation = new Reservation();
        $reservation->client_id = $client->id;
        $reservation->trip_id = $input['trip_id'];
        $reservation->booked_seats_num =$input['booked_seats'];
        $reservation->save();

        $trip = Trip::where('id', '=', $input['trip_id'])->first();
        $avilable = $trip->avilable_seats;

        DB::table('trips')
            ->where('id', '=', $input['trip_id'])
            ->update(['avilable_seats' => $avilable - $input['booked_seats'] ]);

        return response()->json('تم حجر الرحلة ');
       
     }

     public function delayedClientReserve(){
        $input = $request->all();
        $client = new Client();
        $client->name = $input['name'];
        $client->mobile = $input['mobile'];
        $client->save();

        $delayed_reservation = new DelayedReservation();
        $delayed_reservation->booked_seats_num = $input['booked_seats'];
        $delayed_reservation->reserve_date = $input['date'];
        $delayed_reservation->static_trip_id = $input['static_trip_id'];
        $delayed_reservation->save();

     }

     public function getToken(){
        return response()->json(['token'=>csrf_token()]);
     }
   
}
