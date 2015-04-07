<?php

use App\Transfer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TransferTableSeeder extends Seeder {
    public function run(){
        DB::table('transfers')->delete();
        
        for($i = 1; $i <= 10; $i++){
            Transfer::create(['kit_id' => ''.rand(1,5), 'source' => ''.rand(1,8), 'destination' => ''.rand(1,8), 'status' => rand(0,1), 'shipper' => ''.rand(1,30), 'shipped_on' => '2015-03-'.$i, 'receiver' => ''.rand(1,30), 'received_on' => '2015-03-'.($i+2)]);
        }
        
    }
}
