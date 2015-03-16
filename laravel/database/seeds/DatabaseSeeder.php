<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();
		Eloquent::unguard();

		$this->call('UserTableSeeder');
		$this->call('AssetTableSeeder');
		$this->call('KitTableSeeder');
		$this->call('KitAssetTableSeeder');
		$this->call('BookingTableSeeder');
		$this->call('AssociationTableSeeder');
		$this->call('TransferTableSeeder');
		$this->call('KitNoteTableSeeder');
	}
}    
