<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table='persons';
    protected $guarded=[];

    public function reservations(){
        return $this->hasMany('App\Reservation','persons_id','id');
    }
}
