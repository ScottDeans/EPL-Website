<?php namespace App\Http\Controllers;

use DB;
use App\Transfer;
use App\Kit;
use Auth;

class TransfersController extends Controller {

    public function index() {
        $userBranch = Auth::User()->branch;
        TransfersController::dailyRun();
        $incoming = DB::table('transfers')->where('destination', '=', $userBranch)->where('status', '=', 1)->get();
        $outgoing = DB::table('transfers')->where('source', '=', $userBranch)->where('status', '=', 0)->leftJoin('branches', 'transfers.destination', '=', 'branches.branch')->get();
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
        $in4days = date('Y-m-d', strtotime('+4 days'));
        $upcoming = DB::table('bookings')->whereBetween('booking_start', [$now, $in4days])->get();
        foreach ($upcoming as $booking) {
            $kit = $booking->kit_id;    // The kit this booking is using
            $existing = DB::table('bookings')->whereBetween('booking_end', [$now, $booking->booking_start])->where('kit_id', '=', $kit)->where('booking_id', '!=', $booking->booking_id)->orderBy('booking_end')->get();    // A list of in-progress bookings that use the kit.
            $source = DB::table('kits')->where('kit_id', '=', $kit)->pluck('branch');
            if (sizeof($existing) == 0 && !in_array($booking->booking_id, $existingTransfers) && $source != $booking->branch){
                
                Transfer::create(['booking_id'=>$booking->booking_id, 'kit_id'=>$kit, 'source'=>$source, 'destination'=>$booking->branch, 'status'=>0]);
            }        
        }
    }
}
