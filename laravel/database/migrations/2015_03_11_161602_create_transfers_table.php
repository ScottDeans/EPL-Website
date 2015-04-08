<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transfers', function(Blueprint $table)
		{
			$table->increments('transfer_id');
			
			$table->integer('booking_id');
			
			$table->integer('kit_id')->unsigned();
			$table->foreign('kit_id')
			      ->references('kit_id')->on('kits')
			      ->onDelete('cascade')
			      ->onUpdate('cascade');
			
			$table->string('source');
			$table->string('destination');
			$table->integer('status');
			
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
		Schema::drop('transfers');
	}

}
