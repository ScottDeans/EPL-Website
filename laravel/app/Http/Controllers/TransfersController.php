<?php namespace App\Http\Controllers;

class TransfersController extends Controller {

    public function index() {
    
    
        return view('transfers.index');
    }
    
    public function create() {
        return view('transfers.create');
    }
    
    public function show() {
        return view('transfers.update');
    }
}
