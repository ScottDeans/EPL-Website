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
use App\KitType;
class KitController extends Controller {
    
    public function index () {
        $kits = DB::table('kits')->select('kit_id','kit_name','kit_type','branch','barcode')->get();
        $kits = DB::table('kits')->distinct()->get();
 
        return view('kits.index',array('kits'=>$kits))->with('message', 'Project deleted.');
        
    }
    
    public function show($id) {
        $id= intval($id);
    
        $kits = DB::table('kits')->where('kit_id', $id)->first();
        

        $assets = DB::table('kit_assets')->where('kit_id', $id)->lists('asset_id');
        $assetinfo = DB::table('assets')->whereIn('asset_id', $assets)->select('asset_tag','description','broken')->get();  

        $kitstypes = DB::table('kits')->distinct()->orderBy('kit_type')->lists('kit_type');
        $info = DB::table('kits')->where('kit_id', $id)->first(); 
        $kitassets = DB::table('kit_assets')->where('kit_asset_id', $id)->first();
        $notes = DB::table('kit_notes')->where('kit_note_id', $id)->first();

        return view('kits.show', ['kitinfo' => $info,'kitassets' => $kitassets ,'kitnotes' => $notes,'assets' => $assetinfo,'kittypes'=>$kitstypes]);
    }
     public function create( KitAddEditFormRequest $kitnote)
	{

        $branches = DB::table('branches')->distinct()->orderBy('branch_name')->lists('branch_name');
        $kits = DB::table('kits')->select('kit_id','kit_name','kit_type','branch','barcode')->get();
        $kits = DB::table('kits')->distinct()->get();
	
	    $kitstypes = DB::table('kit_types')->distinct()->orderBy('kit_type')->lists('kit_type');

        DB::table('kits')
            ->where('kit_id', $kitnote->id)
            ->update(array('kit_name' => $kitnote->kitname,
            'barcode' => "31221".$kitnote->barcode,
            'kit_type'=> $kitstypes[$kitnote->kittype],
            'branch' => $branches[$kitnote->branch]));

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
	    $kits = DB::table('kits')->where('kit_id',$kitID)->first();
        $users = DB::table('users')->where('name', Auth::User()->name)->first();
	    if(!$users->manager){
	        $kits = DB::table('kits')->distinct()->get();
            return view('kits.index',array('kits'=>$kits))->withErrors(array('message' => 'You are not an admin.'));
	    }
	    $kitstypes = DB::table('kit_types')->distinct()->orderBy('kit_type')->lists('kit_type');
	    $branches = DB::table('branches')->distinct()->orderBy('branch_name')->lists('branch_name');
	
	
        return view('kits.edit' ,['kitID' => $kits,'branches' => $branches,'kittypes'=>$kitstypes]);

	}
	public function report( $kitid,KitFormRequest $kitnote)
	{
	
	    $notes = DB::table('kit_notes')->where('kit_id', $kitnote->id)->first();
	    DB::table('kit_notes')
            ->where('kit_note_id',$kitnote->id)
            ->update(array('kit_note' =>$kitnote->text ));
        $kits = DB::table('kits')->select('kit_id', 'kit_name','kit_type','branch','barcode')->get();
        $kits = DB::table('kits')->distinct()->get();
        return view('kits.index',array('kits'=>$kits));

	}
	public function showadd()
	{
        $users = DB::table('users')->where('name', Auth::User()->name)->first();
	    if(!$users->manager){
	        $kits = DB::table('kits')->distinct()->get();
            return view('kits.index',array('kits'=>$kits))->withErrors(array('message' => 'You are not an admin.'));
	    }
	    $kitstypes = DB::table('kit_types')->distinct()->orderBy('kit_type')->lists('kit_type');
	    $branches = DB::table('branches')->distinct()->orderBy('branch_name')->lists('branch_name');
	
	
   return view('kits.kitadd' ,['branches' => $branches,'kittypes'=>$kitstypes]);

	}

	public function showaddtype()
	{
	    $users = DB::table('users')->where('name', Auth::User()->name)->first();
	    if(!$users->manager){
	        $kits = DB::table('kits')->distinct()->get();
            return view('kits.index',array('kits'=>$kits))->withErrors(array('message' => 'You are not an admin.'));
	    }
	    return view('kits.addkittype');
	}
	
	public function addkittype(KitFormRequest $kitnote)
	{


	    $kittype= new Kittype();
	    $kittype->kit_type = $kitnote->text;
	    $kittype->save();
	    $kits = DB::table('kits')->select('kit_id','kit_name','kit_type','branch','barcode')->get();
        $kits = DB::table('kits')->distinct()->get();
 
        return view('kits.index',array('kits'=>$kits))->with('message', 'Project deleted.');
	
	}
	 public function add( KitAddEditFormRequest $kitnote)
	{
	    $branches = DB::table('branches')->distinct()->orderBy('branch_name')->lists('branch_name');
        $kitstypes = DB::table('kit_types')->distinct()->orderBy('kit_type')->lists('kit_type');
    

	
	    $kitasset= new Kit();
	    $kitasset->kit_name = $kitnote->kitname;
	    $kitasset->barcode = "31221".$kitnote->barcode;
	    $kitasset->kit_type= $kitstypes[$kitnote->kittype];
	    $kitasset->branch = $branches[$kitnote->branch];
	    $kitasset->save();

        $kits = DB::table('kits')->select('kit_id','kit_name','kit_type','branch','barcode')->get();
        $kits = DB::table('kits')->distinct()->get();
 
        return view('kits.index',array('kits'=>$kits))->with('message', 'Project deleted.');

	}
	public function destroy($kitID)
	{
        $users = DB::table('users')->where('name', Auth::User()->name)->first();
	    if(!$users->manager){
	        $kits = DB::table('kits')->distinct()->get();
            return view('kits.index',array('kits'=>$kits))->withErrors(array('message' => 'You are not an admin.'));
	    }
	    DB::table('kits')->where('kit_id', $kitID)->delete();

        $kits = DB::table('kits')->select('kit_id','kit_name','kit_type','branch','barcode')->get();
        $kits = DB::table('kits')->distinct()->get();
 
        return view('kits.index',array('kits'=>$kits))->with('message', 'Project deleted.');
	}
}

