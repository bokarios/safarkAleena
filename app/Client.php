<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reservation;
use App\DelayedReservation;

class Client extends Model {

	public function reservations() {
		return $this->hasMany(Reservation::class);
	}

	public function delayedReservation() {
		return $this->hasMany(DelayedReservation::class);
	}

}
