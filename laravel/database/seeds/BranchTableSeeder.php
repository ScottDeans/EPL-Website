<?php

use App\Branch;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BranchTableSeeder extends Seeder {
    public function run(){
        DB::table('branches')->delete();
        
        Branch::create(['branch_code'=>'ABB', 'branch_name'=>"Abbottsfield"]);
        Branch::create(['branch_code'=>'CAL', 'branch_name'=>"Calder"]);
        Branch::create(['branch_code'=>'CPL', 'branch_name'=>"Capilano"]);
        Branch::create(['branch_code'=>'CSD', 'branch_name'=>"Castle Downs"]);
        Branch::create(['branch_code'=>'CLV', 'branch_name'=>"Clareview"]);
        Branch::create(['branch_code'=>'HIG', 'branch_name'=>"Highlands"]);
        Branch::create(['branch_code'=>'IDY', 'branch_name'=>"Idylwylde"]);
        Branch::create(['branch_code'=>'JPL', 'branch_name'=>"Jasper Place"]);
        Branch::create(['branch_code'=>'LHL', 'branch_name'=>"Lois Hole"]);
        Branch::create(['branch_code'=>'LON', 'branch_name'=>"Londonderry"]);
        Branch::create(['branch_code'=>'GMU', 'branch_name'=>"MacEwan"]);
        Branch::create(['branch_code'=>'MEA', 'branch_name'=>"Meadows"]);
        Branch::create(['branch_code'=>'MLW', 'branch_name'=>"Mill Woods"]);
        Branch::create(['branch_code'=>'RIV', 'branch_name'=>"Riverbend"]);
        Branch::create(['branch_code'=>'SPW', 'branch_name'=>"Sprucewood"]);
        Branch::create(['branch_code'=>'MNA', 'branch_name'=>"Stanley A. Milner Library (Downtown)"]);
        Branch::create(['branch_code'=>'STR', 'branch_name'=>"Strathcona"]);
        Branch::create(['branch_code'=>'WMC', 'branch_name'=>"Whitemud Crossing"]);
        Branch::create(['branch_code'=>'WOO', 'branch_name'=>"Woodcroft"]);
        
    }
}
