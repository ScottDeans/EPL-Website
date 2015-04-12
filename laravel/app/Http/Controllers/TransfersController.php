<?php namespace App\Http\Controllers;

use DB;
use App\Transfer;
use App\Kit;
use Auth;
use Mail;

class TransfersController extends Controller {

    public function index() {
        $userBranch = Auth::User()->branch;
        TransfersController::dailyRun();
        $incoming = DB::table('transfers')->where('destination', '=', $userBranch)->where('status', '=', 1)
                                          ->leftJoin('kits', 'transfers.kit_id', '=', 'kits.kit_id')->get();
        $outgoing = DB::table('transfers')->where('source', '=', $userBranch)->where('status', '=', 0)->leftJoin('branches', 'transfers.destination', '=', 'branches.branch')
                                          ->leftJoin('kits', 'transfers.kit_id', '=', 'kits.kit_id')->get();
        return view('transfers.index',['incoming'=>$incoming, 'outgoing'=>$outgoing]);
    }
    
    public function create() {
        return view('transfers.create');
    }
    
    public function show() {
        return view('transfers.update');
    }
    
    public function update($transferID){
        $transfer = Transfer::Find($transferID);
        $transfer->update(['status'=>1]);
       
        return redirect('transfers/');
    }
    
    public function destroy($transferID){
        $kitID = DB::table('transfers')->where('transfer_id', '=', $transferID)->pluck('kit_id');
        $kit = Kit::Find($kitID);
        $kit->branch = Auth::User()->branch;
        $kit->save();
        
        DB::table('transfers')->where('transfer_id', '=', $transferID)->delete();
        
        return redirect('transfers/');
    }
    
    public static function dailyRun(){
        $existingTransfers = DB::table('transfers')->lists('booking_id');
 
        $now = date('Y-m-d');
        $in5days = date('Y-m-d', strtotime('+5 days'));
        $upcoming = DB::table('bookings')->whereBetween('booking_start', [$now, $in5days])->get();
        foreach ($upcoming as $booking) {
            $kit = $booking->kit_id;    // The kit this booking is using
            $existing = DB::table('bookings')->whereBetween('booking_end', [$now, $booking->booking_start])->where('kit_id', '=', $kit)->where('booking_id', '!=', $booking->booking_id)
                                             ->orderBy('booking_end')->get();    // A list of in-progress bookings that use the kit.
            $source = DB::table('kits')->where('kit_id', '=', $kit)->pluck('branch');
            if (sizeof($existing) == 0 && !in_array($booking->booking_id, $existingTransfers) && $source != $booking->branch){
                
                Transfer::create(['booking_id'=>$booking->booking_id, 'kit_id'=>$kit, 'source'=>$source, 'destination'=>$booking->branch, 'status'=>0]);
            }        
        }
        
        
       
        $holidays = DB::table('holidays')->whereBetween('hday_date', [$now, $in5days])->lists('hday_date');
        
        $outgoing = DB::table('transfers')->where('status', '=', 0)->get();
        $urgent_ids = [];
        $late_ids = [];
        
        foreach ($outgoing as $o){
            $travelDays = 0;
            $arrivalDate = DB::table('bookings')->where('booking_id', '=', $o->booking_id)->pluck('booking_start');
            for ($i = 1, $checkDate = date('Y-m-d'); $checkDate < $arrivalDate; ){
                $day = intval(date('N', strtotime($checkDate)));
                if($day < 6 && !in_array($checkDate, $holidays))
                    $travelDays++;
               
                $i++;
                $checkDate = date('Y-m-d', strtoTime('+'.$i.' days'));
            }
            if ($travelDays == 0)
                array_push($late_ids, $o->transfer_id);
            if ($travelDays == 1)
                array_push($urgent_ids, $o->transfer_id);   
        }
        
        $urgent = DB::table('transfers')->whereIn('transfer_id', $urgent_ids)->leftJoin('users', 'transfers.source', '=', 'users.branch')->where('users.manager', '=', true)
                                        ->leftJoin('kits', 'transfers.kit_id', '=', 'kits.kit_id')
                                        ->leftJoin('branches', 'transfers.destination', '=', 'branches.branch')->select('barcode', 'branch_code', 'branch_name', 'email')->get();
  
        $late = DB::table('transfers')->whereIn('transfer_id', $late_ids)->get();


        foreach ($urgent as $u){
            Mail::send('emails.shipKitNotification', ['key' => $u], function($message) use($u){
                $message->to($u->email)->subject("Urgent attention required for kit ".$u->barcode."!");
            });
        }
        
        foreach ($late as $l){
            $barcode = DB::table('kits')->where('kit_id', '=', $l->kit_id)->pluck('barcode');
            $owner = DB::table('transfers')->where('transfers.transfer_id', '=', $l->transfer_id)->leftJoin('bookings', 'transfers.booking_id', '=', 'bookings.booking_id')
                                           ->leftJoin('users', 'bookings.kit_user', '=', 'users.user_id')->pluck('email');
                                  
            $eventName = DB::table('bookings')->where('booking_id', '=', $l->booking_id)->pluck('event_name');
            $dest = DB::table('branches')->where('branch','=', $l->destination)->pluck('branch_code');
            $src = DB::table('branches')->where('branch','=', $l->source)->pluck('branch_code');
            $manager = DB::table('users')->where('branch', '=', $l->source)->where('manager', '=', true)->pluck('email');
            
            $data = ['barcode' => $barcode, 'eventOwner' => $owner, 'eventName' => $eventName, 'dest' => $dest, 'src' => $src, 'manager' => $manager];
            if ($data['eventOwner'] != null);
            Mail::send('emails.lateKitShipment', ['key' => $data], function($message) use($data){
                $message->to($data['eventOwner'])->subject("Kit #".$data['barcode']." for your event '".$data['eventName']."' will be late.");
            });
        }
    }
}
