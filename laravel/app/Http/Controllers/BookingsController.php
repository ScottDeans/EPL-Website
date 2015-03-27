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
