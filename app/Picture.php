<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $table='pictures';
    protected $guarded=[];

    public function apartament(){

        return $this->belongsTo('App\Apartment','apartments_id','id');
    }
}
