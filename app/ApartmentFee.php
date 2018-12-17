<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApartmentFee extends Model
{
    protected $table='apartments_fee';
    protected $guarded=[];

    public function apartment(){
        return $this->belongsTo('App\Apartments','apartment_id','id');
    }

}
