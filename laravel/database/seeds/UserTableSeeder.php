<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder {
    public function run(){
        DB::table('users')->delete();
        
        $randomFirsts = ['John', 'Jane', 'Bob', 'Alice', 'Bruce', 'Molly', 'Isaac', 'Alyssa', 'Patrick', 'Charlene'];
        $randomLasts = ['Archer', 'Smith', 'Shepard', 'Dubois', 'Doe', 'VanHuis', 'Holmes', 'Watson', 'Stark', 'Banner'];
        
        for($i = 0; $i < 76; $i++){
            $emails = DB::table('users')->lists('email');
        
            $first = $randomFirsts[rand(0,9)];
            $last = $randomLasts[rand(0,9)];
            $email = $first.'.'.$last.'@bar.com'; 
            $emailMod = 1;
            while (in_array($email, $emails)){
                $email = $first.'.'.$last.$emailMod.'@bar.com';
                $emailMod++;
            }
            User::create(['name'=> $first.' '.$last, 'email'=>$email, 'password'=>Hash::make('password'), 'branch'=>''.((int)($i/4) + 1), 'manager'=>(($i % 4) == 0 ? true : false), 'admin'=>(($i % 10) == 0 ? true : false)]);
        }
        
    }
}
