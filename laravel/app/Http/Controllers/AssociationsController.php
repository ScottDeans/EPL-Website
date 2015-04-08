<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Association;
use DB;
use Illuminate\Http\Request;

class AssociationsController extends Controller {

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
	public function store($bookingID, $userID)
	{
	   
	    $newAssoc = new Association();
	    $newAssoc->booking_id = $bookingID;
	    $newAssoc->associated_user = $userID;
	    
	    $newAssoc->save();
		
		return redirect()->action('AssociationsController@show', [$bookingID]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    
    public function show($bookingID){
        $bookingID = intval($bookingID);
        $booking = DB::table('bookings')->where('booking_id', $bookingID)->first();
        
        $assocs = DB::table('associations')->where('booking_id',$bookingID)->lists('associated_user');
        $users = DB::table('users')->whereIn('user_id', $assocs)->get();
        
        
        return view('associations.show', ['booking' => $booking, 'users' => $users]);
    }
    
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
	    $bookingID = intval($id);
	    $booking = DB::table('bookings')->where('booking_id', $bookingID)->first();
	    
	    $assocs = DB::table('associations')->where('booking_id', $bookingID)->lists('associated_user');
	    $users = DB::table('users')->whereNotIn('user_id', $assocs)->get();
	    
		return view('associations.edit', ['booking' => $booking, 'users' => $users]);
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
	public function destroy($bookingID, $userID)
	{
	    $booking = DB::table('bookings')->where('booking_id', $bookingID)->first();
	    DB::table('associations')->where('booking_id', $booking->booking_id)->where('associated_user', $userID)->delete();
	    $users = DB::table('users')->whereIn('user_id', DB::table('associations')->where('booking_id', $booking->booking_id)->lists('associated_user'))->get();
	    return redirect()->back()->withInput(['booking'=>$booking, 'users'=>$users]);
	}
	
	

}
