<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DelayedReservation;

class StaticTrip extends Model {

	public function delayedReservations() {
		return $this->hasMany(DelayedReservation::class, 'id');
	}

}
