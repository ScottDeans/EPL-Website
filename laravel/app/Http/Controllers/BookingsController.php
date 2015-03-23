<?php namespace App\Http\Controllers;

use DB;
use Auth;

class BookingsController extends Controller {
    
    public function index () {
        /*
        $user = DB::table('users')->where('username', Auth::User()->name); //getting the username that matches the currently logged in user
        $branch = DB::table('bookings')->where('branch', Auth::User()->branch);//getting the branch that the user belongs to
        //$bookings = DB::table('bookings')->where('kit_user', Auth::User()->id);//getting the bookings that the user belongs to
        $assocs = DB::table('associations')->where('associated_user', Auth::User()->id)->lists('booking_id');//getting the bookings the user is associated to
        $assocbookings = DB::table('bookings')->whereIn('id', $assocs);//gets the bookings the associated user is assigned to
        */
        //$results = $branch->union($bookings)->union($assocbookings)->get();
        
        //return view('bookings.index', array('bookings'=>$results));
        $user = DB::table('users')->where('name', 'John Doe14')->first();//grabs the name from the database
        $branch = $user->branch;
        $bookings = DB::table('bookings')->select('id', 'kit_user', 'kit_id', 'branch', 'booking_start', 'booking_end')->get();//gets any bookings the user is a kit user of
        $assocs = DB::table('associations')->where('associated_user', $user->id)->lists('booking_id');
        $assocbookings = DB::table('bookings')->whereIn('id', $assocs)->get();//gets the bookings the user is associated with
        
        //var_dump($bookings);
        //var_dump($branch);
        //var_dump($assocbookings);
        return view('bookings.index', array('bookings'=>$bookings, 'branch'=>$branch, 'assocbookings'=>$assocbookings));
        }
    
    public function create() {
        return view('bookings.create');
    }
    
    //public function show($bookingID) {
    /*
        $bookingID = intval($bookingID);
        $booking = DB::table('bookings')->where('id', $bookingID)->first();
        
        $assocs = DB::table('associations')->where('booking_id', $bookingID)->lists('associated_user', $user);
        $users = DB::table('users')->whereIn('id', $assocs)->get();
        
        return view('bookings.show', ['bookings'=> $booking, 'users'=>$users]);
        */
        //return view('bookings.show');
    //}
}
