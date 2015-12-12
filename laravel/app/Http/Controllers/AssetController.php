<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Asset;
use Illuminate\Http\Request;
use Input;
use Validator;
use Auth;

class AssetController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    if(!(Auth::User()->admin || Auth::User()->manager))
	        return redirect()->back();
		$assets = DB::table('assets')->orderBy('asset_tag')->get();
		
		return view('assets.index', ['assets'=>$assets]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    if(!(Auth::User()->admin || Auth::User()->manager))
	        return redirect()->back();
		return view('assets.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
	    if(!(Auth::User()->admin || Auth::User()->manager))
	        return redirect()->back();
	    $input = Input::all();
	    $rules = ['asset_tag' => ['required', 'min:6', 'max:6', 'unique:assets'],
	              'description' => 'required'
	    ];
	        
	    $validator = Validator::make($input, $rules); 
	    
	    if($validator->fails())
	        return redirect()->back()->withErrors($validator);
	       
	        
		$asset = new Asset();
		$asset->asset_tag = $input['asset_tag'];
		$asset->description = $input['description'];
		$asset->broken = false;
		$asset->save();
		
		return redirect('assets/')->withMessage('Asset '.$asset->asset_tag.' created!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	    if(!(Auth::User()->admin || Auth::User()->manager))
	        return redirect()->back();
		return view('assets.confirm', ['id'=>$id]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{   
	    if(!(Auth::User()->admin || Auth::User()->manager))
	        return redirect()->back();
		$asset = Asset::find($id);
		$asset->broken = !$asset->broken;
		$asset->save();
		
		
		return redirect('assets/');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
	    if(!(Auth::User()->admin || Auth::User()->manager))
	        return redirect()->back();
		$asset = Asset::find($id);
		$asset->delete();
		return redirect('assets/');
    }
}
