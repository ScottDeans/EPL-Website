<?php

use App\KitAsset;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class KitAssetTableSeeder extends Seeder {
    public function run(){
        DB::table('kit_assets')->delete();
        
        for($i = 1; $i <= 30; $i++){
            KitAsset::create(['kit_id' => ((int)(($i - 1)/6) + 1), 'asset_id' => $i]);
        }
        
    }
}
