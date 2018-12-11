<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    public function showReservations(){
        $reservations=Reservation::all();

        return view('admin.reservations',compact('reservations'));
    }

    public function changeStatus($id){
        $resarvation=Reservation::find($id);
        if($resarvation->status===1){
            $resarvation->status=0;
        }else{
            $resarvation->status=1;
        }

        $resarvation->save();
        return back()->with('success','Status has been updated!');
    }

    public function addReservation(Request $request){
        dd($request);
        $this->validate($request,[
            'client_name_.*'=>'required|string|max:255',
            'document_type_.*'=>'required',
            'document_nr_.*'=>'required|numeric',
            'document_serial_nr_.*'=>'required|numeric',
            'nationality_.*'=>'required|string|max:255',
            'mage_.*'=>'required',
            'apartment'=>'required',
            'check_in'=>'required|after:yesterday',
            'check_out'=>'required|after_or_equal:check_in'
        ]);

        $reservation=new Reservation();

    }
}
