<?php namespace App\Http\Controllers;

class BookingsController extends Controller {
    
    public function index () {
        return view('bookings.index');
    }
}
