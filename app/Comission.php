<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comission extends Model
{
    protected $table='comissions';
    protected $guarded=[];

    public function apartment(){
        return $this->belongsToMany('App\Apartment','apartments_has_commissions','commissions_id','apartments_id');
    }
}
