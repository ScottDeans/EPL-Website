<?php namespace App\Http\Controllers;

use DB;
use Auth;

class BookingsController extends Controller {

   // protected $user, $bookings, $associations;
    
    /*
    public function _construct(User $user) {
        $this->user = $user;
    }
    
    public function _construct(Bookings $bookings) {
        $this->bookings = $bookings;
    }
    
    public function _construct(Associations $associations) {
        $this->associations = $associations;
    }
    */
    
    public function index () {
        /*
        $user = $this->user->where('name', Auth::User()->name)->first();
        $branch = $user->branch;
        $bookings = $this->bookings->select('id', 'kit_user', 'kit_id', 'event_name', 'branch', 'booking_start', 'booking_end')->get();
        $assocs = $this->associations->where('associated_user', $user->id)->lists('booking_id');
        $assocsbookings = $this->bookings->whereIn('id', $assocs)->get();
        */

        $user = DB::table('users')->where('name', Auth::User()->name)->first(); //getting the username that matches the currently logged in user
        $branch = $user->branch;//getting the branch that the user belongs to
        $bookings = DB::table('bookings')->select('id', 'kit_user', 'kit_id', 'event_name', 'branch', 'booking_start', 'booking_end')->get();
        $assocs = DB::table('associations')->where('associated_user', $user->id)->lists('booking_id');//getting the bookings the user is associated to
        $assocbookings = DB::table('bookings')->whereIn('id', $assocs)->get();//gets the bookings the associated user is assigned to
        
        return view('bookings.index', array('bookings'=>$bookings, 'branch'=>$branch, 'assocbookings'=>$assocbookings));
    }
    
    public function create() {
        return view('bookings.create');
    }
    
    public function show($bookingID) {
    
        $bookingID = intval($bookingID);
        $booking = DB::table('bookings')->where('id', $bookingID)->first();
        
        $assocs = DB::table('associations')->where('booking_id', $bookingID)->lists('associated_user', $user);
        $users = DB::table('users')->whereIn('id', $assocs)->get();
        
        return view('bookings.show', ['bookings'=> $booking, 'users'=>$users]);
    }
}
