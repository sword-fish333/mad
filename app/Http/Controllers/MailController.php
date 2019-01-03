<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MailController extends Controller
{
    public function sendCaretaker($language, $id)
    {
        if ($language === 'spanish') {
            $reservation = Reservation::find($id);
            $apartment = Apartment::where('id', $reservation->apartment_id)->first();
            $to_name = $reservation->name;
            $to_email = $reservation->email;

            $data = array('apartment_name'=>$apartment->name,'location' => $apartment->location,'schedule_check_in'=>$reservation->schedule_check_in, 'check_in' => Carbon::parse($reservation->check_in)->format('m-d-Y'), 'check_out' => Carbon::parse($reservation->check_out)->format('m-d-Y'), 'name' => $reservation->name, 'caretaker' => Session::get('user')->name, 'email' => Session::get('user')->email, 'phone' => Session::get('user')->phone);
            Mail::send('admin.mails.caretaker_spanish', $data, function ($message) use ($to_name, $to_email) {
                $message->to('ghiurcaalin@gmail.com')
                    ->subject(' www.madreamsrent.com:Información de contacto para la entrada de su reserva');
                $message->from(Session::get('user')->email);
            });

            $message = 'The mail was sent successfully';

            return $message;
        }else if($language === 'english'){
            $reservation = Reservation::find($id);
            $apartment = Apartment::where('id', $reservation->apartment_id)->first();
            $to_name = $reservation->name;
            $to_email = $reservation->email;

            $data = array('apartment_name'=>  $apartment->location,'location' => $apartment->location,'schedule_check_in'=>$reservation->schedule_check_in, 'check_in' => Carbon::parse($reservation->check_in)->format('m-d-Y'), 'check_out' => Carbon::parse($reservation->check_out)->format('m-d-Y'), 'name' => $reservation->name, 'caretaker' => Session::get('user')->name, 'email' => Session::get('user')->email, 'phone' => Session::get('user')->phone);
            Mail::send('admin.mails.caretaker_english', $data, function ($message) use ($to_name, $to_email) {
                $message->to('ghiurcaalin@gmail.com')
                    ->subject('www.madreamsrent.com: Contact information for the check in');
                $message->from(Session::get('user')->email);
            });

            $message = 'The mail was sent successfully';
            return $message;
        }else{

            $data=['error','Your message was not sent please try again or check the connection to the server'];
            return $data;
        }
    }
    }

