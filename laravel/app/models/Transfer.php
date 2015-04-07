<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model {
    protected $fillable = ['booking_id','kit_id','source','destination', 'status', 'shipper', 'shipped_on'];
    protected $primaryKey = 'transfer_id';
}
