<?php

namespace App\Http\Controllers;

use App\BookingFee;
use App\Reservation;
use Illuminate\Http\Request;

class ReservationsFeeController extends Controller
{
    public function addFee($id, Request $request){
            $rules=[
              'name'=>'required|string|max:255',
                'description'=>'required|string|max:20000',
                'value'=>'required|numeric|min:0',
                'type_of_value'=>'required'
            ];

            $rulesMessages=[
              'type_of_value.required'=>'the type of fee is required'
            ];

        $this->validate($request, $rules, $rulesMessages);

        $booking_fee=new BookingFee();
        $booking_fee->name=$request->name;
        $booking_fee->description=$request->description;
        $booking_fee->value=$request->value;
        $booking_fee->type_of_value=$request->type_of_value;
        $booking_fee->reservation_id=$id;
        $booking_fee->save();


        return back()->with('success', 'Fee for reservation as been saved successfully!');
    }

    public function deleteFee($id){

        BookingFee::find($id)->delete();

        return back()->with('success' ,' Fee deleted successfully!');
    }

    public  function editFee($id, Request $request){
            $rules=[
            'name'=>'string|max:255',
                'description'=>'string|max:20000',
                'value'=>'numeric|min:0',

            ];
        $this->validate($request, $rules);

        $booking_fee=BookingFee::find($id);
        $booking_fee->name=$request->name;
        $booking_fee->description=$request->description;
        $booking_fee->value=$request->value;
        $booking_fee->type_of_value=$request->type_of_value;
        $booking_fee->save();
        return back()->with('success', 'Fee has been edited successfully');
    }
}
