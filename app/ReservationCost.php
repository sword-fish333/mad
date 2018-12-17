<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationCost extends Model
{
    protected $table='reservation_cost';
    protected $guarded=[];

    public function reservation(){
        return $this->belongsTo('App\Reservation','reservation_id','id');
    }
}
