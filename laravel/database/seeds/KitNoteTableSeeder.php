<?php

use App\KitNote;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class KitNoteTableSeeder extends Seeder {
    public function run(){
        $kits = DB::table('kits')->get();
        
        foreach ($kits as $kit){
            KitNote::Create(['kit_id'=>$kit->kit_id, 'kit_note'=> 'Your text here']);
        }
    }
}
