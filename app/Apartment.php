<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $table='apartments';
    protected $guarded=[];

    public function pictures(){
        return $this->hasMany('App\Picture','apartments_id','id');
    }

    public function reservation(){
        return $this->hasMany('App\Reservation','apartment_id','id');
    }

        public function feature(){
        return $this->hasMany('App\Feature');
        }

        public function price_per_day(){
            return $this->hasMany('App\PricePerDay','apartments_id','id');
        }

        public function holder(){
            return $this->belongsTo('App\ApartmentHolder', 'holder_id', 'id');
        }
}
