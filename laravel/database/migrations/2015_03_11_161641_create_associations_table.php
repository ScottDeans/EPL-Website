<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssociationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('associations', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('booking_id')->unsigned();
			$table->foreign('booking_id')
			      ->references('id')->on('bookings')
			      ->onDelete('cascade')
			      ->onUpdate('cascade');
			
			$table->integer('associated_user')->unsigned();
			$table->foreign('associated_user')
			      ->references('id')->on('users')
			      ->onDelete('cascade')
			      ->onUpdate('cascade');
			
			
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
		Schema::drop('associations');
	}

}
