<?php namespace App\Http\Controllers;


use App\Kit;
use App\KitNote;
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

use Mail;


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
        $notes = DB::table('kit_notes')->where('kit_id', $id)->first();
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


    if(!$asset->broken){
<<<<<<< HEAD
        $kit = DB::table('kits')->where('kit_id', '=', DB::table('kit_assets')->where('asset_id', '=', $assetid)->pluck('kit_id'))->first();
=======
        $assetIDinTable = DB::table('assets')->where('asset_tag', '=', $assetid)->pluck('asset_id');
        $kit = DB::table('kits')->where('kit_id', '=', DB::table('kit_assets')->where('asset_id', '=', $assetIDinTable)->pluck('kit_id'))->first();
        var_dump($kit);
>>>>>>> Adds email notifications to several events. Revamps seeders to generate presentable data.
        $status = in_array($kit->kit_id, DB::table('transfers')->lists('kit_id')) && DB::table('transfers')->where('kit_id', '=', $kit->kit_id)->pluck('status');
        $description = $asset->description;
        $destination = $status ? DB::table('transfers')->where('kit_id', '=', $kit->kit_id)->leftJoin('branches', 'transfers.destination', '=', 'branches.branch')
        ->pluck('branch_code') : null;
        
        $data = ['name' => Auth::User()->name, 'user_branch' => DB::table('branches')->where('branch', '=', Auth::User()->branch)->pluck('branch_code'),
                 'asset_tag' => $assetid, 'description' => $description, 'barcode' => $kit->barcode, 'branch_code' => $destination, 'status' => $status];
        var_dump($data);
        $admins = DB::table('users')->where('admin', '=', true)->lists('email');
        
        foreach ($admins as $admin){
            Mail::send('emails.brokenAsset', ['key' => $data], function($message) use($admin, $data){
                $message->to($admin)->subject("Asset ".$data['asset_tag']." broken.");
            });
        }
<<<<<<< HEAD
        var_dump('Wrote to log');
=======
>>>>>>> Adds email notifications to several events. Revamps seeders to generate presentable data.
    }
	return redirect()->back();

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
            return view('kits.index',array('kits'=>$kits))->withErrors(array('message' => 'You are not a manager.'));
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
            return view('kits.index',array('kits'=>$kits))->withErrors(array('message' => 'You are not a manager.'));
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
            return view('kits.index',array('kits'=>$kits))->withErrors(array('message' => 'You are not an manager.'));
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
<<<<<<< HEAD
	     $branches = DB::table('branches')->distinct()->orderBy('branch_name')->lists('branch_name');
+        $kitstypes = DB::table('kit_types')->distinct()->orderBy('kit_type')->lists('kit_type');
+    
+        
 	
+	    $kitasset= new Kit();
+	    $kitasset->kit_name = $kitnote->kitname;
+	    $kitasset->barcode = "31221".$kitnote->barcode;
+	    $kitasset->kit_type= $kitstypes[$kitnote->kittype];
+	    $kitasset->branch = $branches[$kitnote->branch];
+	    $kitasset->save();
+	    
+	    $kitID = DB::table('kits')->orderBy('created_at', 'desc')->first();
+	
+        $kitnote = new KitNote();
+        $kitnote->kit_id = $kitID->kit_id;
+        $kitnote->kit_note = '';
+        $kitnote->save();
=======
	    $branches = DB::table('branches')->distinct()->orderBy('branch_name')->lists('branch_name');
        $kitstypes = DB::table('kit_types')->distinct()->orderBy('kit_type')->lists('kit_type');
    
        
	
	    $kitasset= new Kit();
	    $kitasset->kit_name = $kitnote->kitname;
	    $kitasset->barcode = "31221".$kitnote->barcode;
	    $kitasset->kit_type= $kitstypes[$kitnote->kittype];
	    $kitasset->branch = $branches[$kitnote->branch];
	    $kitasset->save();
	    
	    $kitID = DB::table('kits')->orderBy('created_at', 'desc')->first();
	
        $kitnote = new KitNote();
        $kitnote->kit_id = $kitID->kit_id;
        $kitnote->kit_note = '';
        $kitnote->save();
>>>>>>> Adds email notifications to several events. Revamps seeders to generate presentable data.

      
        $kits = DB::table('kits')->select('kit_id','kit_name','kit_type','branch','barcode')->get();
        $kits = DB::table('kits')->distinct()->get();
 
        return view('kits.index',array('kits'=>$kits))->with('message', 'Project deleted.');

	}
	public function destroy($kitID)
	{
        $users = DB::table('users')->where('name', Auth::User()->name)->first();
	    if(!$users->manager){
	        $kits = DB::table('kits')->distinct()->get();
<<<<<<< HEAD
            return view('kits.index',array('kits'=>$kits))->withErrors(array('message' => 'You are not a manager.'));
=======
            return view('kits.index',array('kits'=>$kits))->withErrors(array('message' => 'You are not an manager.'));
>>>>>>> Adds email notifications to several events. Revamps seeders to generate presentable data.
	    }
	    DB::table('kits')->where('kit_id', $kitID)->delete();

        $kits = DB::table('kits')->select('kit_id','kit_name','kit_type','branch','barcode')->get();
        $kits = DB::table('kits')->distinct()->get();
 
        return view('kits.index',array('kits'=>$kits))->with('message', 'Project deleted.');
	}
}


