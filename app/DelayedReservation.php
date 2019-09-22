<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\StaticTrip;

class DelayedReservation extends Model {

	public function client() {
		return $this->belongsTo('App\Client');
	}

	public function staticTrip() {
		return $this->belongsTo(StaticTrip::class);
	}

}
