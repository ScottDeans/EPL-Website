<?php

use App\Association;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AssociationTableSeeder extends Seeder {
    public function run(){
        DB::table('associations')->delete();
        
        for($i = 1; $i <= 20; $i++){
            $assoc = new Association();
            $assoc->booking_id = rand(1,10);
            $assoc->associated_user = rand(1,30);
            $assoc->save();
        }
        
    }
}
