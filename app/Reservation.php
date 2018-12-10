<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table='reservations';
    protected $guarded=[];

    public function contract(){
        return $this->hasMany('App\Contract','reservations_id','id');
    }

    public function invoice(){
        return $this->hasOne('App\Invoice','reservations_id','id');
    }

    public function apartment(){
        return $this->belongsTo('App\Apartment','apartment_id','id');
    }

    public function language(){
        return $this->hasOne('App\Language','languages_id','id');
    }

    public function persons(){
        return $this->hasMany('App\Person','persons_id','id');
    }


}
