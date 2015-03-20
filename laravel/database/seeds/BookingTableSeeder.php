<?php

use App\Booking;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BookingTableSeeder extends Seeder {
    public function run(){
        DB::table('bookings')->delete();
        
        for($i = 0; $i < 10; $i++){
            Booking::create(['kit_user'=> rand(1,30), 'kit_id' => rand(1,5), 'event_name'=>'event'.$i,'branch' => rand(1,8), 'booking_start' =>'2015-03-'.($i+1), 'booking_end' =>'2015-03-'.(($i+1) + rand(0,2))]);
        }
        
    }
}
