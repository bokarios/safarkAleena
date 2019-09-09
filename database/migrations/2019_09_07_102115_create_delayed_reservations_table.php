<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDelayedReservationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('delayed_reservations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('client_id');
			$table->integer('trip_id');
			$table->string('source');
			$table->string('destination');
			$table->integer('booked_seats_num');
			$table->date('date');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('delayed_reservations');
	}

}
