<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    protected $table='repair_costs';
    protected $guarded=[];

    public function apartment(){
        return $this->belongsTo('App\Apartment','apartments_id','id');
    }
}
