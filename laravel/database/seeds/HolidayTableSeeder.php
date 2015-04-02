<?php

use App\Holiday;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class HolidayTableSeeder extends Seeder {
    public function run(){
        DB::table('holidays')->delete();
        
        Holiday::create(['holiday'=>"Easter", 'hday_date'=>'2015-04-03']);  
        Holiday::create(['holiday'=>"Easter", 'hday_date'=>'2015-04-05']);
        Holiday::create(['holiday'=>"Easter", 'hday_date'=>'2015-04-06']);
        Holiday::create(['holiday'=>"Victoria Day", 'hday_date'=>'2015-05-18']);
        Holiday::create(['holiday'=>"Canada Day", 'hday_date'=>'2015-07-01']);
        Holiday::create(['holiday'=>"Heritage Day", 'hday_date'=>'2015-08-03']);
        Holiday::create(['holiday'=>"Labour Day", 'hday_date'=>'2015-09-07']);
        Holiday::create(['holiday'=>"Thanksgiving", 'hday_date'=>'2015-10-12']);
        Holiday::create(['holiday'=>"Remembrance Day", 'hday_date'=>'2015-11-11']);
        Holiday::create(['holiday'=>"Christmas", 'hday_date'=>'2015-12-25']);
        Holiday::create(['holiday'=>"Christmas", 'hday_date'=>'2015-12-26']);
        Holiday::create(['holiday'=>"Christmas", 'hday_date'=>'2015-12-28']);
        Holiday::create(['holiday'=>"New Years", 'hday_date'=>'2016-01-01']);
    }
}
