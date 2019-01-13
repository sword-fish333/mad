<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Apartment;
use App\Person;
use App\Reservation;
use App\ReservationPriceList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class MailController extends Controller
{
    public function sendCaretaker($id)
    {
        $reservation = Reservation::find($id);
        if ($reservation->languages_id === 1) {
            $reservation = Reservation::find($id);
            $apartment = Apartment::where('id', $reservation->apartment_id)->first();
            $to_name = $reservation->name;
            $to_email = $reservation->email;
            $caretaker = Admin::where('id', $reservation->caretaker_id)->first();
            $data = array('apartment_name' => $apartment->name, 'location' => $apartment->location, 'schedule_check_in' => $reservation->schedule_check_in, 'check_in' => Carbon::parse($reservation->check_in)->format('m-d-Y'), 'check_out' => Carbon::parse($reservation->check_out)->format('m-d-Y'), 'name' => $reservation->name, 'caretaker' => $caretaker->name, 'email' => $caretaker->email, 'phone' => $caretaker->phone);
            Mail::send('admin.mails.caretaker_spanish', $data, function ($message) use ($to_name, $to_email) {
                $message->to('ghiurcaalin@gmail.com')
                    ->subject(' www.madreamsrent.com:Información de contacto para la entrada de su reserva');
                $message->from('ghiurcaalin@gmail.com');
            });
            if (Mail::failures()) {
                $data = ['error', 'Your message was not sent please try again or check the connection to the server'];
                return $data;
            }
            $message = 'The mail was sent successfully to the client';

            return $message;
        } else {

            $apartment = Apartment::where('id', $reservation->apartment_id)->first();
            $to_name = $reservation->name;
            $to_email = $reservation->email;
            $caretaker = Admin::where('id', $reservation->caretaker_id)->first();

            $data = array('apartment_name' => $apartment->location, 'location' => $apartment->location, 'schedule_check_in' => $reservation->schedule_check_in, 'check_in' => Carbon::parse($reservation->check_in)->format('m-d-Y'), 'check_out' => Carbon::parse($reservation->check_out)->format('m-d-Y'), 'name' => $reservation->name, 'caretaker' => $caretaker->name, 'email' => $caretaker->email, 'phone' => $caretaker->phone);
            Mail::send('admin.mails.caretaker_english', $data, function ($message) use ($to_name, $to_email) {
                $message->to('ghiurcaalin@gmail.com')
                    ->subject('www.madreamsrent.com: Contact information for the check in');
                $message->from('ghiurcaalin@gmail.com');
            });
            if (Mail::failures()) {
                $data = ['error', 'Your message was not sent please try again or check the connection to the server'];
                return $data;
            }
            $message = 'The mail was sent successfully';
            return $message;


        }
    }

    public function sendConfirmationMail($language, $id)
    {

        $reservation = Reservation::find($id);

        $apartment = Apartment::where('id', $reservation->apartment_id)->first();
        $client = Person::where('id', $reservation->persons_id)->first();
        $to_name = $reservation->name;
        $to_email = $reservation->email;
        $guests_nr = Person::where('reservation_id', $id)->count();

        $data = array('guests_nr' => $guests_nr, 'client' => $client, 'apartment' => $apartment, 'reservation' => $reservation);
        if ($language == 1) {
            Mail::send('admin.mails.confirmation_spanish', $data, function ($message) use ($to_name, $to_email) {
                $message->to('ghiurcaalin@gmail.com')
                    ->subject('www.madreamsrent.com: Confirmación de su reserva para el piso');
                $message->from('ghiurcaalin@gmail.com');
            });
            return Mail::failures();
        } elseif ($language == 2) {
            Mail::send('admin.mails.confirmation_english', $data, function ($message) use ($to_name, $to_email) {
                $message->to('ghiurcaalin@gmail.com')
                    ->subject('www.madreamsrent.com: Booking confirmation in the apartment');
                $message->from('ghiurcaalin@gmail.com');
            });
            return Mail::failures();
        } else {
            return 'error';
        }

    }

    public function sendReminderMail()
    {
        $reservations = Reservation::all();
        foreach ($reservations as $reservation) {
            $apartment = Apartment::where('id', $reservation->apartment_id)->first();
            $client = Person::where('id', $reservation->persons_id)->first();
            $to_name = $reservation->name;
            $to_email = $reservation->email;
            $guests_nr = Person::where('reservation_id', $reservation->id)->count();

            $data = array('guests_nr' => $guests_nr, 'client' => $client, 'apartment' => $apartment, 'reservation' => $reservation);
            if ($reservation->languages_id === 1) {
                Mail::send('admin.mails.reminder_spanish', $data, function ($message) use ($to_name, $to_email) {
                    $message->to('ghiurcaalin@gmail.com')
                        ->subject('www.madreamsrent.com: Recordatorio de su reserva para el piso ');
                    $message->from('ghiurcaalin@gmail.com');
                });
            } else {
                Mail::send('admin.mails.reminder_english', $data, function ($message) use ($to_name, $to_email) {
                    $message->to('ghiurcaalin@gmail.com')
                        ->subject('www.madreamsrent.com: Reminder next reservation in the apartment');
                    $message->from('ghiurcaalin@gmail.com');
                });
            }
        }
    }

    public function sendReservationInfoMail($language, $id)
    {
        $reservation = Reservation::find($id);

        $apartment = Apartment::where('id', $reservation->apartment_id)->first();
        $client = Person::where('id', $reservation->persons_id)->first();
        $to_name = $reservation->name;
        $to_email = $reservation->email;
        $guests_nr = Person::where('reservation_id', $id)->count();
        $total = ReservationPriceList::totalReservationPrice($id);
        $data = array('guests_nr' => $guests_nr, 'client' => $client, 'apartment' => $apartment, 'reservation' => $reservation, 'total' => $total);
        if ($language == 1) {
            Mail::send('admin.mails.reservation_info_spanish', $data, function ($message) use ($to_name, $to_email) {
                $message->to('ghiurcaalin@gmail.com')
                    ->subject(' www.madreamsrent.com: Solicitud de confirmación de reserva para el piso ');
                $message->from('ghiurcaalin@gmail.com');
            });
            return Mail::failures();
        } elseif ($language == 2) {
            Mail::send('admin.mails.reservation_info_english', $data, function ($message) use ($to_name, $to_email) {
                $message->to('ghiurcaalin@gmail.com')
                    ->subject('www.madreamsrent.com: Confirmation for the booking request in the apartment');
                $message->from('ghiurcaalin@gmail.com');
            });
            return Mail::failures();
        } else {
            return 'error';
        }
    }

    public function sendPaymentStatus($payment_status, $id)
    {
        $reservation = Reservation::find($id);

            $apartment = Apartment::where('id', $reservation->apartment_id)->first();
            $client = Person::where('id', $reservation->persons_id)->first();
            $to_name = $reservation->name;
            $to_email = $reservation->email;
            $guests_nr = Person::where('reservation_id', $reservation->id)->count();
        $data = array('guests_nr' => $guests_nr, 'client' => $client, 'apartment' => $apartment, 'reservation' => $reservation);

        if($payment_status==='full') {
                Mail::send('admin.mails.confirm_payment_spanish', $data, function ($message) use ($to_name, $to_email) {
                    $message->to('ghiurcaalin@gmail.com')
                        ->subject('www.madreamsrent.com: Reserva hecha para el piso ');
                    $message->from('ghiurcaalin@gmail.com');
                });
                    return Mail::failures();
            }else{
                Mail::send('admin.mails.rejected_payment_spanish', $data, function ($message) use ($to_name, $to_email) {
                    $message->to('ghiurcaalin@gmail.com')
                        ->subject('www.madreamsrent.com: Reserva rechazada para el piso ');
                    $message->from('ghiurcaalin@gmail.com');
                });

                return Mail::failures();
            }

    }
}

