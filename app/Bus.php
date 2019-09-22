<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model {

	public function trips() {
		return $this->hasMany(Trip::class);
	}

}
