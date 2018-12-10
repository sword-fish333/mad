<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table='invoices';
    protected $guarded=[];

    public function reservation(){
        return $this->belongsTo('App\Reservation','reservations_id','id');
    }

}
