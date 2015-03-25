<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Association extends Model {

    protected $table = 'associations';

	public $fillable;
	
	function __construct(){
	    $this->fillable = ['booking_id', 'associated_user'];
	}

}
