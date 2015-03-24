<?php namespace App\Http\Controllers;

use App\kit;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
 use App\Http\Requests\KitFormRequest;
 use App\Http\Requests\KitAddEditFormRequest;
 use Auth;
use DB;

class KitController extends Controller {
    
    public function index () {
        $kits = DB::table('kits')->select('id', 'kit_description','kit_name','kit_type','current_location','barcode')->get();
        $kits = DB::table('kits')->distinct()->get();
     
        return view('kits.index',array('kits'=>$kits));
        
    }
    
    public function show($id) {
        //would gather information about the selected kit from the database
         $booking = DB::table('kits')->where('id', $id)->first();
        return view('kits.show', ['kitinfo' => $booking]);
    }
    public function store($bookingID, $userID)
	{
	}
	  public function report( KitFormRequest $kitnote,$kitid)
	{
	
   $kits = DB::table('kits')->select('id', 'kit_description','kit_name','kit_type','current_location','barcode')->get();
   $kits = DB::table('kits')->distinct()->get();
   return view('kits.index',array('kits'=>$kits));

	}
	public function showadd()
	{
   return view('kits.kitadd');

	}
	 public function add( KitAddEditFormRequest $kitnote)
	{
	$user = DB::table('users')->where('username', Auth::User()->name);
	if(!$user->manager=1){
	/*
	$kitnote->name;
	$kitnote->type;
	$kitnote->location;
	$kitnote->barcode;
	$kitnote->tags;
	$kitnote->content;
	$kitnote->description;*/
	//$auth=Auth::user()->name
	DB::table('kits')->insert(
    ['kit_name' => $kitnote->name,'id' => $kitnote->id,  
    'kit_type' => $kitnote->type,'current_location' => $kitnote->location,
    'barcode' => $kitnote->barcode,'kit_description' => $kitnote->description]
);
	}
   $kits = DB::table('kits')->select('id', 'kit_description','kit_name','kit_type','current_location','barcode')->get();
   $kits = DB::table('kits')->distinct()->get();
   return view('kits.index',array('kits'=>$kits));

	}
}


