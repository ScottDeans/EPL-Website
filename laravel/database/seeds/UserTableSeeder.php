<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTableSeeder extends Seeder {
    public function run(){
        DB::table('users')->delete();
        
        for($i = 0; $i < 30; $i++){
            User::create(['name'=> 'John Doe'.$i, 'email'=>'foo'.$i.'@bar.com', 'password'=>Hash::make('password'), 'branch'=>''.((int)($i/4) + 1), 'manager'=>(($i % 4) == 0 ? true : false), 'admin'=>(($i % 10) == 0 ? true : false)]);
        }
        
    }
}
