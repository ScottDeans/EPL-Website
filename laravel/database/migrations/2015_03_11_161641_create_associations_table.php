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
			$table->increments('association_id');
			
			$table->integer('booking_id')->unsigned();
			$table->foreign('booking_id')
			      ->references('booking_id')->on('bookings')
			      ->onDelete('cascade')
			      ->onUpdate('cascade');
			
			$table->integer('associated_user')->unsigned();
			$table->foreign('associated_user')
			      ->references('user_id')->on('users')
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
