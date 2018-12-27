<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\ApartmentCost;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;
class ApartmentCostController extends Controller
{
    public function addCost($id, Request $request){

        $validator=Validator::make($request->all(),[
            'price'=>'required|numeric|min:0',
            'start_date'=>'required',
            'end_date'=>'required',

        ]);

        $ap_costs=ApartmentCost::where('apartment_id', $id)->get();
        foreach ($ap_costs as $ap_cost){
            if($ap_cost->start_date>=$request->start_date ||$ap_cost->end_date>=$request->end_date){
                $message=[];
                $message['status']='error';
                $message['info_error']='You need to insert a date that dose not interfere with the other dates for this apartment';

                $message=json_encode($message);
                return $message;
            }
        }
        if( Carbon::parse($request->start_date)->toDateTimeString()<Carbon::today() || Carbon::parse($request->end_date)->toDateTimeString()<Carbon::parse($request->start_date)->toDateTimeString()
         ){
            $message=[];
            $message['status']='error';
            $message['info_error']='You need to insert a start date that is today or after today , and end date that is after start date';

            $message=json_encode($message);
            return $message;
        }

        if($validator->fails()){
            $message=[];
            $message['status']='error';
            $message['info_error']='All fields are required and the price has to be bigger than 0';

            $message=json_encode($message);
            return $message;
        }
        $apartment_cost=new ApartmentCost();
        $apartment_cost->price=$request->price;
        $apartment_cost->start_date=$request->start_date;
        $apartment_cost->end_date=$request->end_date;
        $apartment_cost->apartment_id=$id;
        $apartment_cost->save();



        $message=[];
        $message['status']='success';
        $message['info_success'] = 'Cost for the given date was added successfully';
        $message = json_encode($message);
        return $message;
    }

    public function viewCosts($id){
        $ap=Apartment::where('id', $id)->first();
        $apartment_costs=ApartmentCost::where('apartment_id',$ap->id)->get();
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
            $message=[];
            $message['status']='error';
            $message['info_error']='You need to insert a start date that is today or after today , and end date that is after start date';

            $message=json_encode($message);
            return $message;
        }
        if($request->price<0){
            $message=[];
            $message['status']='error';
            $message['info_error']='The value must be bigger than 0';

            $message=json_encode($message);
            return $message;
        }
        $apartment_cost= ApartmentCost::find($id);
        $apartment_cost->price=$request->price;
        $apartment_cost->start_date=$request->start_date;
        $apartment_cost->end_date=$request->end_date;

        $apartment_cost->save();


        $message=[];
        $message['status']='success';
        $message['info_success'] = 'Cost was edited successfully';
        $message = json_encode($message);
        return $message;
    }
}
