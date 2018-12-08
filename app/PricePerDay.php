<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PricePerDay extends Model
{
    protected $table='prices_apartments_per_day';
    protected $guarded=[];

    public function apartment(){
        return $this->belongsTo('App\Apartment','apartments_id','id');
    }
}
