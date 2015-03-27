<?php namespace App\Http\Controllers;

use DB;
use Auth;
use App\Booking;
use App\kits;
use Illuminate\Database\Eloquent\Model;
use Request;
use Validator;
use Redirect;
use Input;
use View;

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

    public function confirm(){
        $input = Request::all();
        // Applying validation rules.
        $rules = array(
            'kitType' => 'required',
		    'Start_Date' => 'required|date|after:today',
	    	'End_Date' => 'required|date|after:Start_Date',
	    	'branch_code' => 'required',
	    	'event_name' => 'required'
	        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()){
            // If validation fails redirect back to login.
            return Redirect::to('/bookings/create')->withInput(Input::except('dates'))->withErrors($validator);
        }
        else {
            $kits = DB::table('kits')->where('kit_type', '=', $input['kitType'])->lists('id');
            foreach($kits as $kit){
                $booking_start_dates = DB::table('bookings')->orderBy('booking_start')->where('kit_id', '=', $kit)->lists('booking_start');
                $booking_end_dates = DB::table('bookings')->orderBy('booking_start')->where('kit_id', '=', $kit)->lists('booking_end');
                $index = 0;
                $available = true;
                foreach($booking_start_dates as $start_date){
                    $preBlackout = 1;
                    $postBlackout = 1;
                    
                    if(date("w",strtotime($start_date)) == 1){$preBlackout = 3;}
                    if(date("w",strtotime($start_date)) == 0){$preBlackout = 2;}
                    if(date("w",strtotime($booking_end_dates[$index])) == 4 || date("w",strtotime($booking_end_dates[$index])) == 5){$postBlackout = 3;}
                    if(date("w",strtotime($booking_end_dates[$index])) == 6){$postBlackout = 2;}
                    if(strtotime($input['End_Date']) < strtotime($start_date) - ($preBlackout * 86400)){break;}
                    elseif(strtotime($input['Start_Date']) < strtotime($booking_end_dates[$index]) + ($postBlackout * 86400)){
                        $available = false;
                        break;
                    }
                    $index++;
                }
                if($available){
                    $booking_data = array(
                        'kitType' => $input['kitType'],
		                'Start_Date' => $input['Start_Date'],
	    	            'End_Date' => $input['End_Date'],
	    	            'branch_code' => $input['branch_code'],
	    	            'kit_id' => $kit,
	    	            'event_name' => $input['event_name']
                    );
                    return view('bookings.confirm', $booking_data);
                }
            }
            return Redirect::to('/bookings/create')->withInput(Input::except('dates'))->withErrors($validator);
        }
    }
    
    public function store(){
        $input = Request::all();
        $id_key = DB::table('bookings')->orderBy('id', 'desc')->lists('id');
        $booking = new Booking();
        $booking->kit_user = Auth::User()->id;
        $booking->branch = $input['branch_code'];
        $booking->booking_end = $input['End_Date'];
        $booking->booking_start = $input['Start_Date'];
        $booking->kit_id = $input['kit_id'];
        $booking->id = $id_key[0] + 1;
        $booking->created_at = date("Y-m-d H:i:s", strtotime("now"));
        $booking->event_name = $input['event_name'];
        $booking->save();
        
        return view('bookings.landing', array('booking_id' => ($id_key[0] + 1)));

    }
}
