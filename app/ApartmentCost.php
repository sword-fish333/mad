<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApartmentCost extends Model
{
    protected $table='apartments_prices';
    protected $guarded=[];

    public function apartment(){
        return $this->belongsTo('App\Apartments','apartment_id','id');
    }
}
