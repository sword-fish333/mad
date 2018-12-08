<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table='contracts';
    protected $guarded=[];

    public function reservation(){
        return $this->belongsTo('App\Reservation','reservations_id','id');
    }
}
