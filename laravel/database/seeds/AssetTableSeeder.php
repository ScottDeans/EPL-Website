<?php

use App\Asset;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AssetTableSeeder extends Seeder {
    public function run(){
        DB::table('assets')->delete();
        
        $baseTypes = DB::table('kit_types')->lists('kit_type');
        $numTypes = sizeof($baseTypes) - 1;
        $itemTypes  = ['', 'Power Supply', 'Case'];
        
        for($i = 0; $i < 30; $i++){
            $baseType = $baseTypes[rand(0, $numTypes)];
            $itemType = $itemTypes[rand(0, 2)];
            
            Asset::create(['asset_tag' => ''.rand(0,9).rand(0,9).rand(0,9).rand(0,9).($i < 10 ? rand(0,9) : '').$i, 'description' => $baseType.' '.$itemType, 'broken'=>false]);
        } 
    }
}
