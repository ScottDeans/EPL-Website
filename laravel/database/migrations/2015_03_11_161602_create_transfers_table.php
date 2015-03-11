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
			$table->increments('id');
			
			$table->integer('kit_id')->unsigned();
			$table->foreign('kit_id')
			      ->references('id')->on('kits')
			      ->onDelete('cascade')
			      ->onUpdate('cascade');
			
			$table->string('source');
			$table->string('destination');
			$table->string('status');
			$table->date('date_status_changed');
			
			$table->integer('status_update_actor')->unsigned();
			$table->foreign('status_update_actor')
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
		Schema::drop('transfers');
	}

}
