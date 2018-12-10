<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $table='features';
    protected $guarded=[];

    public function apartment(){
        return $this->belongsToMany('App\Apartment','apartments_has_features','apartments_id','features_id');
    }
}
