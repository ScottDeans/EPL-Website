<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bookings', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('kit_user')->unsigned();
			$table->foreign('kit_user')
			      ->references('id')->on('users')
			      ->onDelete('cascade')
			      ->onUpdate('cascade');
			     			
			$table->integer('kit_id')->unsigned();
			$table->foreign('kit_id')
			      ->references('id')->on('kits')
			      ->onDelete('cascade')
			      ->onUpdate('cascade');
			
			$table->integer('event_id')->unsigned();
			$table->foreign('event_id')
			      ->references('id')->on('events')
			      ->onDelete('cascade')
			      ->onUpdate('cascade');
			
			$table->integer('kit_booker')->unsigned();
			$table->foreign('kit_booker')
			      ->references('id')->on('users')
			      ->onDelete('cascade')
			      ->onUpdate('cascade');
			      
			$table->date('booking_start');
			$table->date('booking_end');
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
		Schema::drop('bookings');
	}

}
