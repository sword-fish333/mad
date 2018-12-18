<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApartmentHolder extends Model
{
    protected $table='apartments_holders';
    protected $guarded=[];

    public function apartment(){
        return $this->hasMany('App\Apartment','holder_id','id');
    }
}
