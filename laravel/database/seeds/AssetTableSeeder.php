<?php

use App\Asset;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AssetTableSeeder extends Seeder {
    public function run(){
        DB::table('assets')->delete();
        
        for($i = 0; $i < 30; $i++){
            Asset::create(['asset_tag' => decbin($i), 'description'=> "Asset ".$i]);
        }
        
    }
}
