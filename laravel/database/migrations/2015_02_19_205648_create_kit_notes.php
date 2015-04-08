<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitNotes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kit_notes', function(Blueprint $table)
		{
			$table->increments('kit_note_id');
			
			$table->integer('kit_id')->unsigned();
			$table->foreign('kit_id')
			      ->references('kit_id')->on('kits')
			      ->onDelete('cascade')
			      ->onUpdate('cascade');
			
			$table->string('kit_note');      
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
		Schema::drop('kit_notes');
	}

}
