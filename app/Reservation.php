<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;

class Reservation extends Model {

	public function client() {
		return $this->belongsTo(Client::class);
	}

	public function trip() {
		return $this->belongsTo(Trip::class);
	}

}
