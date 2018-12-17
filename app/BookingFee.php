<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingFee extends Model
{
    protected $table='booking_fees';
    protected $guarded=[];

    public function reservations(){
        return $this->belongsTo('App\Reservation','fee_id','id');
    }
}
