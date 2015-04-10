<?php namespace App\Http\Controllers;

use DB;
use Auth;
use App\Booking;
use App\kits;
use App\Association;
use Illuminate\Database\Eloquent\Model;
use Request;
use Validator;
use Redirect;
use Input;
use View;

class BookingsController extends Controller {
    
    public function index () {

        $user = DB::table('users')->where('name', Auth::User()->name)->first(); //getting the username that matches the currently logged in user
        $branch = $user->branch;//getting the branch that the user belongs to
        $bookings = DB::table('kits')->leftJoin('bookings', 'kits.kit_id', '=', 'bookings.kit_id')->leftJoin('branches', 'bookings.branch', '=', 'branches.branch')->leftJoin('users', 'bookings.kit_user', '=', 'users.user_id')->get();
        $assocs = DB::table('associations')->where('associated_user', $user->user_id)->lists('booking_id');//getting the bookings the user is associated to
        $assocbookings = DB::table('bookings')->whereIn('booking_id', $assocs)->leftJoin('branches', 'bookings.branch', '=', 'branches.branch')->leftJoin('users', 'bookings.kit_user', '=', 'users.user_id')->leftJoin('kits', 'bookings.kit_id', '=', 'kits.kit_id')->get();//gets the bookings the associated user is assigned to

        return view('bookings.index', ['bookings'=>$bookings, 'branch'=>$branch, 'assocbookings'=>$assocbookings]);
    }
    
    public function show($bookingID) {
    
        $bookingID = intval($bookingID);
        $booking = DB::table('bookings')->where('booking_id', $bookingID)->first();
        
        $assocs = DB::table('associations')->where('booking_id', $bookingID)->lists('associated_user');
        $users = DB::table('users')->whereIn('user_id', $assocs)->get();
        
        return view('bookings.show', ['bookings'=> $booking, 'users'=>$users]);

    }
    
    public function edit($bookingID) {
        $bookingID = intval($bookingID);
        $booking = DB::table('bookings')->where('booking_id', $bookingID)->first();
        
        return view ('bookings.edit', ['bookings' => $booking]);
    }
    
    public function destroy($bookingID) {
        $bookingID = intval($bookingID);
        DB::table('bookings')->where('booking_id', '=', $bookingID)->delete();
        
        $user = DB::table('users')->where('name', Auth::User()->name)->first(); //getting the username that matches the currently logged in user
        $branch = $user->branch;//getting the branch that the user belongs to
        $bookings = DB::table('kits')->leftJoin('bookings', 'kits.kit_id', '=', 'bookings.kit_id')->leftJoin('branches', 'bookings.branch', '=', 'branches.branch')->leftJoin('users', 'bookings.kit_user', '=', 'users.user_id')->get();
        $assocs = DB::table('associations')->where('associated_user', $user->user_id)->lists('booking_id');//getting the bookings the user is associated to
        $assocbookings = DB::table('bookings')->whereIn('user_id', $assocs)->leftJoin('branches', 'bookings.branch', '=', 'branches.branch')->leftJoin('users', 'bookings.kit_user', '=', 'users.user_id')->leftJoin('kits', 'bookings.kit_id', '=', 'kits.kit_id')->get();//gets the bookings the associated user is assigned to
        
        return redirect()->back()->withInput(['bookings'=>$bookings, 'branch'=>$branch, 'assocbookings'=>$assocbookings]);
    }

    public function create() {
        $branch_codes = DB::table('branches')->lists('branch_code');
        $branch_names = DB::table('branches')->lists('branch_name');
        $kit_types = DB::table('kit_types')->lists('kit_type');
        return view('bookings.create', ['branch_codes' => $branch_codes, 'branch_names' => $branch_names,'kit_types' => $kit_types]);
    }

    public function create_b(){
        $input = Request::all();
        // Applying validation rules.
        $end_check = date('c', strtotime("-1 day", strtotime($input['Start_Date'])));
        $input['or_on_start_date'] = $end_check;
        $rules = array(
            'kitType' => 'required',
		    'Start_Date' => 'required|date|after:tomorrow',
	    	'End_Date' => 'required|date|after:or_on_start_date',
	    	'branch_code' => 'required'
	        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()){
            // If validation fails redirect back to login.
            return Redirect::to('/bookings/create')->withErrors($validator);
        }
        else {
            $kits = DB::table('kits')->where('kit_type', '=', $input['kitType'])->lists('kit_id');
            foreach($kits as $kit){
                $booking_start_dates = DB::table('bookings')->orderBy('booking_start')->where('kit_id', '=', $kit)->lists('booking_start');
                $booking_end_dates = DB::table('bookings')->orderBy('booking_start')->where('kit_id', '=', $kit)->lists('booking_end');
                $index = 0;
                $available = true;
                
                $preBlackout = 1;
                $postBlackout = 1;
                
                if(date("w",strtotime($input['Start_Date'])) == 1){$preBlackout = 3;}
                if(date("w",strtotime($input['Start_Date'])) == 0){$preBlackout = 2;}
                if(date("w",strtotime($input['End_Date'])) == 4 || date("w",strtotime($input['End_Date'])) == 5){$postBlackout = 4;}
                if(date("w",strtotime($input['End_Date'])) == 6){$postBlackout = 2;}
                
                foreach($booking_start_dates as $start_date){
                    if(strtotime($input['End_Date']) < strtotime($start_date) - ($postBlackout * 86400)){break;}
                    elseif(strtotime($input['Start_Date']) < strtotime($booking_end_dates[$index]) + ($preBlackout * 86400)){
                        $available = false;
                        break;
                    }
                    $index++;
                }
                if($available){
                    $branch = DB::table('branches')->where('branch_code', $input['branch_code'])->lists('branch');
                    $branch_uname = DB::table('users')->orderBy('name')->where('branch', $branch)->lists('name');
                    $branch_uid = DB::table('users')->orderBy('name')->where('branch', $branch)->lists('user_id');
                    $data = array(
                        'branch_uname' => $branch_uname,
                        'branch_uid' => $branch_uid,
                        'kitType' => $input['kitType'],
		                'Start_Date' => $input['Start_Date'],
	    	            'End_Date' => $input['End_Date'],
	    	            'branch_code' => $input['branch_code'],
	    	            'kit_id' => $kit
                    );
                    return view('bookings.create_b', $data);
                }
            }
            return Redirect::to('/bookings/create')->withErrors("No kit available for these dates.");
        }
    }
    
    public function confirm(){
        $input = Request::all();
        // Applying validation rules.
        $rules = array(
            'event_name' => 'required',
            );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()){
            // If validation fails redirect back to login.
            return Redirect::to('/bookings/create_b')->withErrors($validator);
        }
        else {
            $associated_array = DB::table('users')->whereIn('user_id', $input['associated_users'])->lists('name');
            $associated_names = implode(', ', $associated_array);
            $input['associated_names'] = $associated_names;
                       
            $associated_users = implode(',', $input['associated_users']);
            $input['associated_users'] = $associated_users;
            
            $input['event_name'] = preg_replace("/[\s]/", "_", $input['event_name']);
            
            $input['kit_name'] = DB::table('kits')->where('kit_id', $input['kit_id'])->pluck('kit_name');

            return view('bookings.confirm', $input);
            }
    }
    
    public function store(){
        $input = Request::all();
        $id_key = DB::table('bookings')->orderBy('booking_id', 'desc')->lists('booking_id');
        $input['event_name'] = preg_replace("/[_]/", " ", $input['event_name']);
        $branch = DB::table('branches')->where('branch_code', $input['branch_code'])->lists('branch');
        
        $booking = new Booking();
        $booking->kit_user = Auth::User()->user_id;
        $booking->branch = $input['branch_code'];
        $booking->booking_end = $input['End_Date'];
        $booking->booking_start = $input['Start_Date'];
        $booking->kit_id = $input['kit_id'];
        $booking->booking_id = $id_key[0] + 1;
        $booking->created_at = date("Y-m-d H:i:s", strtotime("now"));
        $booking->event_name = $input['event_name'];
        $booking->save();
        
        
        $associated_users = explode(',', $input['associated_users']);
        foreach($associated_users as $user_id){
            $newAssoc = new Association();
	        $newAssoc->booking_id = $id_key[0] + 1;
	        $newAssoc->associated_user = $user_id;
	    
	        $newAssoc->save();
        }
        
        $newAssoc = new Association();
	    $newAssoc->booking_id = $id_key[0] + 1;
	    $newAssoc->associated_user = Auth::User()->user_id;
	    
	    $newAssoc->save();
	    
        
        return view('bookings.landing', array('booking_id' => ($id_key[0] + 1)));

    }
}
