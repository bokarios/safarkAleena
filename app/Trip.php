<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reservation;

class Trip extends Model {

	public function bus(){
		return $this->belongsTo('App\Bus');
	}

	public function reservations() {
		return $this->hasMany(Reservation::class);
	}

}
