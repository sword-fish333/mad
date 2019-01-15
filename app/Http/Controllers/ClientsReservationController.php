<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Newsletter;
use App\Person;
use App\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ClientsReservationController extends Controller
{
    public function makeReservation($id, Request $request)
    {

        $rules = [
            'guests_nr' => 'required|integer|min:0',
            'check_in' => 'required|date|after:yesterday',
            'check_out' => 'required|date|after:check_in',
            'name' => 'required|string|max:2000',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:8,14',
            'nr_document' => 'required|string',
            'seria_document' => 'nullable|string|max:2000',
            'language' => 'required|numeric',
            'nationality' => 'required|numeric',
            'newsletter'=>'nullable',
            'document_type'=>'required|string'
        ];
        $customMessages = [
            'language.numeric' => 'You have to choose a language',
            'nationality.numeric' => 'You have to choose a nationality',

        ];

        $this->validate($request, $rules, $customMessages);

        if (empty($request->nr_document) || empty($request->seria_document)) {
            return back()->with('error', 'You have to enter The Number on your ID or the serie on it. Please try again');
        }
        if($request->terms != 1){
            return back()->with('error', 'You have to check the terms and conditions of MadreamRent in order for the reservation to be submited!');
        }
        $apartment = Apartment::find($id);
        if ($apartment->status === 'blocked') {
            return back()->with('error', 'This apartment is blocked please try again with another apartment');

        }
        if($request->newsletter==1){
            $newsletter=new Newsletter();
            $newsletter->name=$request->name;
            $newsletter->email=$request->email;
            $newsletter->save();
        }

        $reservation = new Reservation();
        $reservation->name = $request->name;
        $reservation->email = $request->email;
        $reservation->phone = $request->phone;
        $reservation->check_in = Carbon::parse($request->check_in)->toDateString();
        $reservation->check_out = Carbon::parse($request->check_out)->toDateString();
        $reservation->apartment_id = $id;
        $reservation->guests_nr = $request->guests_nr;
        $reservation->languages_id = $request->language;
        $reservation->newsletter=$request->newsletter;
        $client = new Person();
        $client->name = $request->name;
        $client->document_type=$request->document_type;
        $client->document_nr = $request->nr_document;
        $client->document_serial_nr = $request->seria_document;
        $client->nationality = $request->nationality;
        $client->save();
        $reservation->persons_id=$client->id;
        $reservation->save();
        $client->reservation_id = $reservation->id;
        $client->save();
        Session::flash('success', 'Reservation completed!');
        return redirect('clients/finish/reservation');
    }

    public function NewsletterSubscription(Request $request){
        $this->validate(request(), [
            'name'=>'required|string|max:2000',
            'email'=>'required|email|max:2000'
            ]);

        $newsletter=new Newsletter();
        $newsletter->name=$request->name;
        $newsletter->email=$request->email;
        $newsletter->save();

        return redirect('clients/finish/reservation')->with('success','You have successfully subscribe to our newsletter. Congratulations!');
    }

    public function showFinalReservation(){

        return view('client.finish_reservation');
    }
}
