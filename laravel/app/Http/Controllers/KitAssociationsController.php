<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Association;
use DB;
use Illuminate\Http\Request;
use App\KitAssociations;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\KitFormRequest;
use App\Http\Requests\KitAddEditFormRequest;
use Auth;
use Redirect;
use App\KitAsset;
use Validator;

use Input;
use View;
class KitAssociationsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($assetID, $kitID)
	{
	 $kitID = intval($kitID);
	/*$kitasset= new KitAsset();
	$kitasset->id=$assetID;
	$kitasset->kit_id=$kitID;
	$kitasset->save();*/
	
	$kitasset=DB::table('kit_assets')->get();
	$kits = DB::table('kits')->where('kit_id', $kitID)->first();
    $assets = DB::table('kit_assets')->where('kit_id', $kitID)->lists('asset_id');
    $assetinfo = DB::table('assets')->whereIn('asset_id', $assets)->select('asset_id','asset_tag','description','broken')->get();
	return view('kitassociations.show', [ 'assets' => $assetinfo, 'kitID' =>  $kits]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    
    public function show($kitID){
        $kitID = intval($kitID);
        $kits = DB::table('kits')->where('kit_id', $kitID)->first();
        
        $assets = DB::table('kit_assets')->where('kit_id', $kitID)->lists('asset_id');
        $assetinfo = DB::table('assets')->whereIn('asset_id', $assets)->select('asset_id','asset_tag','description','broken')->get();
        
        return view('kitassociations.show', [ 'assets' => $assetinfo, 'kitID' =>  $kits]);

    }
    
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
	    $kitID = intval($id);
	    $kit= DB::table('kits')->where('kit_id', $kitID)->first();
	    $kitassets= DB::table('kit_assets')->lists('asset_id');
	    $users = DB::table('assets')->whereNotIn('asset_id', $kitassets)->select('asset_id','asset_tag','description','broken')->get();

		return view('kitassociations.edit', ['kit' => $kit, 'users' => $users]);
		
		
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($assetID, $kitID)
	{
	    $kit = DB::table('kits')->where('kit_id', $kitID)->first();
	    DB::table('kit_assets')->where('kit_id', $kit->kit_id)->where('asset_id', $assetID)->delete();
	    $kits = DB::table('kits')->where('kit_id', $kitID)->first();
        
        $assets = DB::table('kit_assets')->where('kit_id', $kitID)->lists('kit_asset_id');
        $assetinfo = DB::table('assets')->whereIn('asset_id', $assets)->select('asset_id','asset_tag','description','broken')->get();
        
        return view('kitassociations.show', [ 'assets' => $assetinfo, 'kitID' =>  $kits]);
	}
	
	

}
