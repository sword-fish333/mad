<?php

namespace App\Http\Controllers;

use App\Person;
use App\Reservation;
use Carbon\Carbon;
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

      $rules=[
            'main_name'=>'required|string|max:255',
            'main_document_type'=>'required',
            'main_email'=>'required',
            'main_phone'=>'required|digits_between:8,14',
            'main_document_nr'=>'required',
            'main_document_serial_nr'=>'required',
            'main_nationality'=>'required',
            'main_document_picture'=>'required',
            'apartment' => 'required',
            'check_in' => 'required|after:yesterday',
            'check_out' => 'required|after_or_equal:check_in'
            ];
        $custom_messages=[
            'after'=>'The check in may not be before today!',
            'after_or_equal'=>'The check out may not e before the check In '
        ];
        $this->validate($request, $rules, $custom_messages);

            $main_photo=  \App\Http\Controllers\FilesController::uploadFile($request, 'main_document_picture', 'document_photos', array("jpg", "jpeg", "png", "gif"), false);
            $reservation=new  Reservation();
            $reservation->name=$request->main_name;
             $reservation->email=$request->main_email;
           $reservation->phone=$request->main_phone;
            $reservation->check_in=$request->check_in;
            $reservation->check_out=$request->check_out;
            $reservation->apartment_id=$request->apartment;
            $person=new Person();
            $person->name=$request->main_name;
            $person->document_type=$request->main_document_type;
            $person->document_nr=$request->main_document_nr;
            $person->document_serial_nr=$request->main_document_serial_nr;
            $person->nationality=$request->main_nationality;
            $person->document_picture=$main_photo;
            $person->reservation_id=$reservation->id;
            $person->save();
            $reservation->persons_id=$person->id;
            $reservation->save();


        if($request->client_name) {
            $this->validate($request, [
                'client_name' => 'required|max:255',
                'document_type' => 'required',
                'document_nr' => 'required',
                'document_serial_nr' => 'required',
                'nationality' => 'required|max:255',
                'image' => 'required',

            ]);
            if(count($request->document_type)!=count($request->client_name)){
                return back()->with('error' ,'You may choose only one type of ID');
            }
            $photo = \App\Http\Controllers\FilesController::uploadFile($request, 'image', 'document_photos', array("jpg", "jpeg", "png", "gif"), true);
            for ($i=0; $i<count($request->client_name);$i++){
                $client=new Person();
                $client->name=$request->client_name[$i];
                $client->document_type=$request->document_type[$i];
                $client->document_nr=$request->document_nr[$i];
                $client->document_serial_nr=$request->document_serial_nr[$i];
                $client->nationality=$request->nationality[$i];
                $client->document_picture=$photo[$i];
                $client->reservation_id=$reservation->id;
                $client->save();



            }

        }
            return back()->with('success', 'The reservation has been saved successfully!');
    }

    public function editReservations($id, Request $request){

        $rules=[
            'main_name'=>'string|max:255',
            'main_nationality'=>'string|max:255',
            'main_email'=>'email',
            'main_phone'=>'digits_between:8,14',
            'check_in' => 'required|after:yesterday',
            'check_out' => 'required|after_or_equal:check_in'
        ];

        $custom_messages=[
            'after'=>'The check in may not be before today!',
            'after_or_equal'=>'The check out may not be before the check In '
        ];
        $this->validate($request, $rules, $custom_messages);
        if(!empty($request->document_type)) {
            if (count($request->document_type) != count($request->client_name)) {
                return back()->with('error', 'You may choose only one type of ID');
            }
        }
        $reservation=Reservation::find($id);

        $reservation->name=$request->main_client_name;
        $reservation->email=$request->main_client_email;
        $reservation->phone=$request->main_client_phone;
        $reservation->check_in=$request->check_in;
        $reservation->check_out=$request->check_out;
        $reservation->apartment_id=$request->apartment;
        $reservation->save();
        $main_client=Person::where('id', $reservation->persons_id)->first();
        $main_client->name=$request->main_name;
        $main_client->document_type=$request->main_document_type;
        $main_client->document_nr=$request->main_document_nr;
        $main_client->document_serial_nr=$request->main_document_serial_nr;
        $main_client->nationality=$request->main_nationality;

        if($request->main_profie_image){
            $photo = \App\Http\Controllers\FilesController::uploadFile($request, 'main_profile_image', 'document_photos', array("jpg", "jpeg", "png", "gif"), false);
                $main_client->document_picture=$photo;
        }
        $main_client->save();





            $clients=Person::where('reservation_id', $id)->get();
        if($request->client_image) {
            $client_photos = \App\Http\Controllers\FilesController::uploadFile($request, 'client_image', 'document_photos', array("jpg", "jpeg", "png", "gif"), true);
        }


            if(!empty($request->client_name)) {
                for ($i = 0; $i < count($request->client_name); $i++) {

                    $clients[$i]->name = $request->client_name[$i];
                    $clients[$i]->document_type = $request->document_type[$i];
                    $clients[$i]->document_nr = $request->client_document_nr[$i];
                    $clients[$i]->document_serial_nr = $request->client_document_serial_nr[$i];
                    $clients[$i]->nationality = $request->nationality[$i];
                   // $clients[$i]->document_picture = $client_photos[$i];
                    $clients[$i]->reservation_id = $reservation->id;
                    $clients[$i]->save();
                }
            }

        return back()->with('success', 'The Reservation has been edited successfully!');
    }

    public function changeClientImage($id, Request $request){
        dd($id);

          $client=Person::where('id', $id)->first();
        $client_photo = \App\Http\Controllers\FilesController::uploadFile($request, 'client_image'.$id, 'document_photos', array("jpg", "jpeg", "png", "gif"), false);
   $client->document_picture=$client_photo;
     $client->save();

     return 1;
    }


}
