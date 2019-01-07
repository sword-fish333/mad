<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReservationPriceList extends Model
{
    protected $table='reservation_prices_list';
    protected $guarded=[];

    public static function totalReservationPrice($id){
            $costs_reservation=ReservationPriceList::where('reservation_id', $id)->get();
            $total_cost=0;
            foreach ($costs_reservation as $cost){
                if($cost->type_of_value!=="%"){
                    $total_cost+=$cost->price;
                }else{
                    $total_cost=$total_cost+($cost->price/100)*$total_cost;
                }

            }

            return number_format($total_cost,2);
    }
}
