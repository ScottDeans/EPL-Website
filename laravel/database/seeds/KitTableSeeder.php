<?php

use App\Kit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class KitTableSeeder extends Seeder {
    public function run(){
        DB::table('kits')->delete();
        
        $types = DB::table('kit_types')->lists('kit_type');
        $numtypes = sizeof($types) - 1;
        
        $numBranches = sizeof(DB::table('branches')->lists('branch'));
        
        for($i = 0; $i < 8; $i++){
            $randomizedKitType = $types[rand(0, $numtypes)];
            $randomizedBarcode = '3122100000000'.$i;
            $randomBranch = rand(1, $numBranches);
            
            
            Kit::create(['kit_name' => $randomizedKitType.' Kit ', 'barcode' => $randomizedBarcode, 'kit_type' => $randomizedKitType, 'branch' => $randomBranch]);
        }
        
    }
}
