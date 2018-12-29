<?php

namespace App\Http\Controllers;

use App\BookingFee;
use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ReservationsFeeController extends Controller
{
    public function addFee($id, Request $request){

        $validator = Validator::make($request->all(), [
              'name'=>'required|string|max:255',
                'description'=>'required|string|max:20000',
                'value'=>'required|numeric|min:0',
                'type_of_value'=>'required'
            ]);



        if($validator->fails()){
            $message=[];
            $message['status']='error';
            $message['info_error']='You need to insert value that is bigger than  0 and all fields are required';

            $message=json_encode($message);
            return $message;
        }

        $booking_fee=new BookingFee();
        $booking_fee->name=$request->name;
        $booking_fee->description=$request->description;
        $booking_fee->value=$request->value;
        $booking_fee->type_of_value=$request->type_of_value;
        $booking_fee->reservation_id=$id;
        $booking_fee->save();


        $message=[];
        $message['status']='success';
        $message['info_success'] = 'Fee was added successfully';
        $message = json_encode($message);
        return $message;
    }

    public function deleteFee($id){

        BookingFee::find($id)->delete();

        $message=[];
        $message['status']='success';
        $message['info_success'] = 'Fee was deleted successfully';
        $message = json_encode($message);
        return $message;
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

    public function viewFees($id){
        $booking_fees=BookingFee::where('reservation_id',$id)->get();
        $booking_fees=json_encode($booking_fees);
        return $booking_fees;
    }
}
