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
        $branchbookings = DB::table('bookings')->where('bookings.branch', $user->branch)->leftJoin('kits', 'bookings.kit_id', '=', 'kits.kit_id')->leftJoin('branches', 'bookings.branch', '=', 'branches.branch')->leftJoin('users', 'bookings.kit_user', '=', 'users.user_id')->get();//gets the user's branch bookings
        $assocs = DB::table('associations')->where('associated_user', $user->user_id)->lists('booking_id');//getting the bookings the user is associated to
        $assocbookings = DB::table('bookings')->whereIn('booking_id', $assocs)->leftJoin('branches', 'bookings.branch', '=', 'branches.branch')->leftJoin('users', 'bookings.kit_user', '=', 'users.user_id')->leftJoin('kits', 'bookings.kit_id', '=', 'kits.kit_id')->get();//gets the bookings the associated user is assigned to
        $userbookings = DB::table('bookings')->where('kit_user', $user->user_id)->leftJoin('kits', 'bookings.kit_id', '=', 'kits.kit_id')->leftJoin('branches', 'bookings.branch', '=', 'branches.branch')->leftJoin('users', 'bookings.kit_user', '=', 'users.user_id')->get();//gets the bookings that the user created
        
		return view('bookings.index', ['bookings'=>$branchbookings, 'assocbookings'=>$assocbookings, 'userbookings'=>$userbookings]);
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
        $booking = DB::table('bookings')->where('booking_id', $bookingID)->leftJoin('branches', 'bookings.branch', '=', 'branches.branch')->leftJoin('kits', 'bookings.kit_id', '=', 'kits.kit_id')->first();
        $types = DB::table('kits')->lists('kit_type');
        $branch_codes = DB::table('branches')->lists('branch_code');
        $branch_names = DB::table('branches')->lists('branch_name');
        
        return view ('bookings.edit', ['booking' => $booking, 'types' => $types, 'branch_codes' => $branch_codes, 'branch_name' => $branch_names]);
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
                    $branch_uname = DB::table('users')->orderBy('name')->where('user_id', '!=', Auth::User()->user_id)->lists('name');
                    $branch_uid = DB::table('users')->orderBy('name')->where('user_id', '!=', Auth::User()->user_id)->lists('user_id');
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
            if(!array_key_exists('associated_users', $input))
                $input['associated_users'] = [];
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
    
    public function update_b($bookingID){
    
        $input = Request::all();
        // Applying validation rules.
        var_dump($input);
        $rules = array(
            'kitType' => 'required',
		    'Start_Date' => 'required|date|after:today',
	    	'End_Date' => 'required|date|after:Start_Date',
	    	'branch_code' => 'required'
	        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()){
            // If validation fails redirect back to login.
            //return redirect()->back()->withInput(Input::except('dates'))->withErrors($validator);
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
                
                if(date("w",strtotime($input['Start_Date'])) == 1){$preBlackout = 4;}
                if(date("w",strtotime($input['Start_Date'])) == 0){$preBlackout = 3;}
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
                    var_dump($input['branch_code']);
                    $branch_uname = DB::table('users')->orderBy('name')->where('branch', $input['branch_code'])->lists('name');
                    $branch_uid = DB::table('users')->orderBy('name')->where('branch', $input['branch_code'])->lists('user_id');
                    
                    $data = array(
                        'branch_uname' => $branch_uname,
                        'branch_uid' => $branch_uid,
                        'kitType' => $input['kitType'],
		                'Start_Date' => $input['Start_Date'],
	    	            'End_Date' => $input['End_Date'],
	    	            'branch_code' => $input['branch_code'],
	    	            'kit_id' => $kit
                    );
                    var_dump($data);
                    
                    return view('bookings.update_b');
                }
            }
            //return redirect()->back()->withInput(Input::except('dates'))->withErrors("No kit available for these dates.");
        }
    }
    
    public function store(){
        $input = Request::all();
        $id_key = DB::table('bookings')->orderBy('booking_id', 'desc')->lists('booking_id');
        $input['event_name'] = preg_replace("/[_]/", " ", $input['event_name']);
        $branch = DB::table('branches')->where('branch_code', $input['branch_code'])->pluck('branch');
        
        $booking = new Booking();
        $booking->kit_user = Auth::User()->user_id;
        $booking->branch = $branch;
        $booking->booking_end = $input['End_Date'];
        $booking->booking_start = $input['Start_Date'];
        $booking->kit_id = $input['kit_id'];
        $booking->event_name = $input['event_name'];
        $booking->save();
        
        $bookingID = DB::table('bookings')->orderBy('created_at', 'desc')->first()->booking_id;
        
        if (strlen($input['associated_users']) > 0)
            $associated_users = explode(',', $input['associated_users']);
        else
            $associated_users = [];
        
        foreach($associated_users as $user_id){
            $newAssoc = new Association();
	        $newAssoc->booking_id = $bookingID;
	        $newAssoc->associated_user = $user_id;
	    
	        $newAssoc->save();
        }
	            
        return view('bookings.landing', array('booking_id' => ($bookingID)));

    }
}
