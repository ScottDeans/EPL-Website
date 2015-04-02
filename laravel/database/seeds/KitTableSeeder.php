<?php

use App\Kit;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class KitTableSeeder extends Seeder {
    public function run(){
        DB::table('kits')->delete();
        
        for($i = 0; $i < 5; $i++){
            Kit::create(['kit_name' => ''.$i, 'barcode' => decbin($i), 'kit_type' => ($i < 2) ? 'iPad' : 'Laptop', 'branch' => rand(1,8)]);
        }
        
    }
}
