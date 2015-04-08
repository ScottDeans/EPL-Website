<?php namespace App\Http\Controllers;


use App\Kit;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\KitFormRequest;
use App\Http\Requests\KitAddEditFormRequest;
use Auth;
use Redirect;
use DB;
use App\Booking;
use Validator;
use Input;
use View;

class KitController extends Controller {
    
    public function index () {
        $kits = DB::table('kits')->select('kit_id','kit_name','kit_type','branch','barcode')->get();
        $kits = DB::table('kits')->distinct()->get();
 
        return view('kits.index',array('kits'=>$kits))->with('message', 'Project deleted.');
        
    }
    
    public function show($id) {
        $id= intval($id);
    
        $kits = DB::table('kits')->where('kit_id', $id)->first();
        
        $assets = DB::table('kit_assets')->where('kit_id', $id)->lists('kit_asset_id');
        $assetinfo = DB::table('assets')->whereIn('asset_id', $assets)->select('asset_tag','description','broken')->get();  
        $kitstypes = DB::table('kits')->distinct()->orderBy('kit_type')->lists('kit_type');
        $info = DB::table('kits')->where('kit_id', $id)->first(); 
        $kitassets = DB::table('kit_assets')->where('kit_asset_id', $id)->first();
        $notes = DB::table('kit_notes')->where('kit_note_id', $id)->first();
        var_dump([$info, $kitassets, $notes, $assetinfo, $kitstypes]);
        return view('kits.show', ['kitinfo' => $info,'kitassets' => $kitassets ,'kitnotes' => $notes,'assets' => $assetinfo,'kittypes'=>$kitstypes]);
    }
     public function create( KitAddEditFormRequest $kitnote)
	{
	

	$user = DB::table('users')->where('username', Auth::User()->name);
	if($user->manager=1){
	//$auth=Auth::user()->name
    DB::table('kits')
            ->where('kit_id', $kitnote->id)
            ->update(array('kit_name' => $kitnote->kitname,
            'barcode' => $kitnote->barcode,
            'kit_type'=> $kitnote->kittype,
            'branch' => $kitnote->branch));
	}
        $kits = DB::table('kits')->select('kit_id','kit_name','kit_type','branch','barcode')->get();
        $kits = DB::table('kits')->distinct()->get();
 
        return view('kits.index',array('kits'=>$kits))->with('message', 'Project deleted.');

	}
    public function update($assetid)
	{
	
    $asset = DB::table('assets')->where('asset_tag', $assetid)->first();
	DB::table('assets')
            ->where('asset_tag', $asset->asset_tag)
            ->update(array('broken' =>!$asset->broken ));

		return redirect()->back();
	}
    public function store($bookingID, $userID)
	{
	}
	  public function edit($kitID)
	{
	$kitID= intval($kitID);
		$kitstypes = DB::table('kits')->distinct()->orderBy('kit_type')->lists('kit_type');
	$branches = DB::table('branches')->distinct()->orderBy('branch_name')->lists('branch_name');
	
	
   return view('kits.edit' ,['kitID' => $kitID,'branches' => $branches,'kittypes'=>$kitstypes]);

	}
	  public function report( $kitid,KitFormRequest $kitnote)
	{
	 $notes = DB::table('kit_notes')->where('id', $kitnote->id)->first();
	 $addedtext=$kitnote->text." , ".$notes->kit_note;
	DB::table('kit_notes')
            ->where('kit_note_id',$kitnote->id)
            ->update(array('kit_note' =>$addedtext ));
   $kits = DB::table('kits')->select('kit_id', 'kit_description','kit_name','kit_type','current_location','barcode')->get();
   $kits = DB::table('kits')->distinct()->get();
   return view('kits.index',array('kits'=>$kits));

	}
	public function showadd()
	{
	$kitstypes = DB::table('kits')->distinct()->orderBy('kit_type')->lists('kit_type');
	$branches = DB::table('branches')->distinct()->orderBy('branch_name')->lists('branch_name');
	
	
   return view('kits.kitadd' ,['branches' => $branches,'kittypes'=>$kitstypes]);

	}
	
	public function showaddtype(){
	return view('kits.addkittype');
	}
	 public function add( KitAddEditFormRequest $kitnote)
	{
	

	$user = DB::table('users')->where('username', Auth::User()->name);
	if($user->manager=1){
	//$auth=Auth::user()->name
	$kitasset= new Kit();
	$kitasset->kit_name = $kitnote->kitname;
	$kitasset->barcode = $kitnote->barcode;
	$kitasset->kit_type= $kitnote->kittype;
	$kitasset->branch = $kitnote->branch;
	$kitasset->save();


	}
        $kits = DB::table('kits')->select('kit_id','kit_name','kit_type','branch','barcode')->get();
        $kits = DB::table('kits')->distinct()->get();
 
        return view('kits.index',array('kits'=>$kits))->with('message', 'Project deleted.');

	}
		public function destroy($kitID)
	{
	    DB::table('kits')->where('kit_id', $kitID)->delete();

        
        $kits = DB::table('kits')->select('kit_id','kit_name','kit_type','branch','barcode')->get();
        $kits = DB::table('kits')->distinct()->get();
 
        return view('kits.index',array('kits'=>$kits))->with('message', 'Project deleted.');
	}
}


