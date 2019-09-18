<?php 
namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Trip;
use App\Bus;
use DB;
use Illuminate\Http\Request;

class TripsApiController extends Controller {


    public function getTrips(Request $request){
        $trips = Trip::with(['bus'])->get();
        return response()->json((object)$trips);
    }
	
}
