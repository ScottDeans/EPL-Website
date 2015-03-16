<?php

use App\KitNote;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class KitNoteTableSeeder extends Seeder {
    public function run(){
        DB::table('kit_notes')->delete();
        
        for($i = 1; $i <= 5; $i++){
            for ($j = 1; $j <= 10; $j++){
                KitNote::create(['kit_id' => $i, 'kit_note'=> "Kit ".$i. ", Note ".$j]);
            }
        }
        
    }
}
