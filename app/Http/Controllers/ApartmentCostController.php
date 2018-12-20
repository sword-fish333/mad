<?php

namespace App\Http\Controllers;

use App\ApartmentCost;
use Illuminate\Http\Request;
use Carbon\Carbon;
class ApartmentCostController extends Controller
{
    public function addCost($id, Request $request){

        $this->validate($request,[
            'price'=>'required|numeric|min:0',
            'start_date'=>'required',
            'end_date'=>'required',

        ]);
        if( Carbon::parse($request->start_date)->toDateTimeString()<Carbon::today() || Carbon::parse($request->end_date)->toDateTimeString()<Carbon::parse($request->start_date)->toDateTimeString()
         ){
            return back()->with('error',' The check in may only start from today and the check out must be after the check in!');
        }
        $apartment_cost=new ApartmentCost();
        $apartment_cost->price=$request->price;
        $apartment_cost->start_date=$request->start_date;
        $apartment_cost->end_date=$request->end_date;
        $apartment_cost->apartment_id=$id;
        $apartment_cost->save();


        return back()->with('success', 'Fee for reservation as been saved successfully!');
    }

    public function viewCosts($id){
        $apartment_costs=ApartmentCost::where('apartment_id',$id)->get();
            foreach ($apartment_costs as $apartment_cost){
                $apartment_cost->start_date=Carbon::parse($apartment_cost->start_date)->toDateString();
                $apartment_cost->end_date=Carbon::parse($apartment_cost->end_date)->toDateString();
            }
        $apartment_costs=json_encode($apartment_costs);
        return $apartment_costs;
    }

    public function deletePrice($id){

        ApartmentCost::find($id)->delete();
    }

    public function editCost($id, Request $request){


        if( Carbon::parse($request->start_date)->toDateTimeString()<Carbon::today() || Carbon::parse($request->end_date)->toDateTimeString()<Carbon::parse($request->start_date)->toDateTimeString()
         ){
            return back()->with('error',' The check in may only start from today and the check out must be after the check in!');
        }
        $apartment_cost= ApartmentCost::find($id);
        $apartment_cost->price=$request->price;
        $apartment_cost->start_date=$request->start_date;
        $apartment_cost->end_date=$request->end_date;

        $apartment_cost->save();


        return back()->with('success', 'Fee for reservation as been saved successfully!');
    }
}
