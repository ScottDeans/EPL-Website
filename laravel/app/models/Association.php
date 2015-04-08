<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Association extends Model {

    protected $table = 'associations';
    protected $primaryKey = 'association_id';

	public $fillable;
	
	function __construct(){
	    $this->fillable = ['booking_id', 'associated_user'];
	}

}
