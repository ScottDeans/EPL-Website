<?php namespace App\Http\Controllers;

class KitController extends Controller {
    
    public function index () {
        return view('kits.index');
    }
    
    public function show() {
        //would gather information about the selected kit from the database
        return view('kits.show');
    }
}
