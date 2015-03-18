<?php namespace App;

use Illuminate\Database\Eloquent\Model;
class Kit extends Model {

	//
    protected $table = 'kits';
    protected $fillable = ['id','kit_type','kit_name','kit_description'];
}
