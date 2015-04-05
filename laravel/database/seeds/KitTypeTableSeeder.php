<?php

use App\KitType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class KitTypeTableSeeder extends Seeder {
    public function run(){
        DB::table('kit_types')->delete();
        
        KitType::create(['kit_type'=> 'iPad']);
        KitType::create(['kit_type'=> 'Laptop']);
        KitType::create(['kit_type'=> 'XBox']);
        KitType::create(['kit_type'=> 'Arduino']);
        KitType::create(['kit_type'=> 'iPad Mini']);
        
    }
}
