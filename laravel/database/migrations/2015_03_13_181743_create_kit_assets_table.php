<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKitAssetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('kit_assets', function(Blueprint $table)
		{
			$table->increments('id');
			
			$table->integer('kit_id')->unsigned();
			$table->foreign('kit_id')
			      ->references('id')->on('kits')
			      ->onDelete('cascade')
			      ->onUpdate('cascade');
			      
			$table->integer('asset_id')->unsigned()->unique();
			$table->foreign('asset_id')
			      -> references('id')->on('assets')
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
		Schema::drop('kit_assets');
	}

}
