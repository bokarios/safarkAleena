<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reservation;
use App\DelayedReservation;
use App\StaticTrip;

class Client extends Model {

	public function reservations() {
		return $this->hasMany(Reservation::class);
	}

	public function delayedReservation() {
		return $this->hasMany(DelayedReservation::class);
	}

	public function staticTrips() {
		return $this->hasMany(StaticTrip::class);
	}

}
