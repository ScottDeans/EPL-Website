<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kit_contents', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('kit_id')->unsigned();
			$table->foreign('kit_id')
			      ->references('id')->on('kits')
			      ->onDelete('cascade')
			      ->onUpdate('cascade');
			
			$table->string('content_description');
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
		Schema::drop('kit_contents');
	}

}
