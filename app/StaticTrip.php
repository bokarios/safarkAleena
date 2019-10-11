<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DelayedReservation;
use App\Client;

class StaticTrip extends Model {

	public function delayedReservations() {
		return $this->hasMany(DelayedReservation::class, 'id');
	}

	public function client() {
		return $this->belongsTo(Client::class);
	}

}
