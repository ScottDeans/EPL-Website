<?php namespace App\Http\Controllers;

use App\kit;
use Illuminate\Database\Eloquent\Model;
use DB;

class KitController extends Controller {
    
    public function index () {
        $kits = DB::table('kits')->select('id', 'kit_description','kit_name','kit_type','current_location','barcode')->get();
        $kits = DB::table('kits')->distinct()->get();
        return view('kits.index',array('kits'=>$kits));
        
    }
    
    public function show() {
        //would gather information about the selected kit from the database
        return view('kits.show');
    }
}

