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
			      ->references('id')->on('kits')
			      ->onDelete('cascade')
			      ->onUpdate('cascade');
			
			$table->string('source');
			$table->string('destination');
			$table->integer('status');
			
			$table->integer('shipper')->unsigned()->nullable();
			$table->foreign('shipper')
			      ->references('id')->on('users')
			      ->onDelete('cascade')
			      ->onUpdate('cascade');
			      
			$table->date('shipped_on');
			      
			$table->integer('receiver')->unsigned()->nullable();
			$table->foreign('receiver')
			      ->references('id')->on('users')
			      ->onDelete('cascade')
			      ->onUpdate('cascade');
			      
			$table->date('received_on');
			
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
