<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\ApartmentComissionHistory;
use App\ApartmentCost;
use App\ApartmentFee;
use App\ApartmentHolder;
use App\BookingFee;
use App\Person;
use App\Reservation;
use App\ReservationCost;
use App\ReservationPriceList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDF;
use Illuminate\Support\Facades\DB;

class ReservationsController extends Controller
{
    public function showReservations()
    {
        $reservations = Reservation::orderBy('created_at','desc')->get();

        return view('admin.reservations', compact('reservations'));
    }

    public function changeStatus($id)
    {
        $resarvation = Reservation::find($id);
        if ($resarvation->status === 1) {
            $resarvation->status = 0;
        } else {
            $resarvation->status = 1;
        }

        $resarvation->save();
        return back()->with('success', 'Status has been updated!');
    }

    public function addReservation(Request $request)
    {

        if (Carbon::parse($request->check_in)->toDateTimeString() < Carbon::today() || Carbon::parse($request->check_out)->toDateTimeString() < Carbon::parse($request->check_in)->toDateTimeString()) {
            return back()->with('error', ' The check in may only start from today and the check out must be after the check in!');
        }
        if(Carbon::parse($request->schedule_check_in)->toDateTimeString()<Carbon::parse($request->check_in)->toDateTimeString()){
            return back()->with('error', ' The Schedule check in may not be before the actuale check in!');

        }
        $reservations = Reservation::where('apartment_id', $request->apartment)->get();

        $ok = 1;
        $data = [];
        if ($reservations) {
            foreach ($reservations as $res) {
                if ((Carbon::parse($request->check_in)->toDateTimeString() >= $res->check_in && Carbon::parse($request->check_in)->toDateTimeString() <= $res->check_out) ||
                    (Carbon::parse($request->check_out)->toDateTimeString() >= $res->check_in && Carbon::parse($request->check_out)->toDateTimeString() <= $res->check_out)
                ) {
                    $ok = 0;
                    $data['in'] = $res->check_in;
                    $data['out'] = $res->check_out;

                    break;
                }
            }
        }

        if ($ok === 0) {
            $date['in'] = Carbon::parse($data['in'])->format('m-d-Y H:i');
            $date['out'] = Carbon::parse($data['out'])->format('m-d-Y H:i');
            return back()->with('error', 'The apartment has been taken between ' . $data['in'] . ' and ' . $data['out']);
        }
        if (!empty($request->holder)) {
            $rules = [
                'apartment' => 'required'
            ];
            $this->validate($request, $rules);
            $person = new Person();
            $ap = Apartment::where('id', $request->apartment)->first();
            $holder = ApartmentHolder::where('id', $ap->holder_id)->first();
            $reservation = new  Reservation();
            $reservation->name = $holder->name;
            $reservation->email = $holder->email;
            $reservation->phone = $holder->phone;
            $reservation->check_in = $request->check_in;
            $reservation->check_out = $request->check_out;
            $reservation->schedule_check_in = $request->schedule_check_in;
            $reservation->apartment_id = $request->apartment;
            $person->name = $holder->name;
            $person->document_type = 'holder';
            $person->document_nr = null;
            $person->document_serial_nr = null;
            $person->nationality = null;
            $person->document_picture = $holder->document_photo;
            $person->reservation_id = $reservation->id;
            $person->save();
            $reservation->persons_id = $person->id;
            $reservation->save();
            $day = Carbon::parse($request->check_in);
            while ($day <= Carbon::parse($request->check_out)) {
                $reservation_price_list = new ReservationPriceList();
                $reservation_price_list->name = 'Holder reservation';
                $reservation_price_list->price = 0;
                $reservation_price_list->day = $day;
                $reservation_price_list->reservation_id = $reservation->id;
                $reservation_price_list->save();
                $day->addDays(1);
            }
            return back()->with('success', 'The reservation has been saved successfully!');
        } else {
            $rules = [
                'main_name' => 'required|string|max:255',
                'main_document_type' => 'required',
                'main_email' => 'required',
                'main_phone' => 'required|digits_between:8,14',
                'main_document_nr' => 'required',
                'main_document_serial_nr' => 'required',
                'main_nationality' => 'required',
                'main_document_picture' => 'required',
                'apartment' => 'required',

            ];
            $this->validate($request, $rules);


            $main_photo = \App\Http\Controllers\FilesController::uploadFile($request, 'main_document_picture', 'document_photos', array("jpg", "jpeg", "png", "gif"), false);


            $reservation = new  Reservation();
            $reservation->name = $request->main_name;
            $reservation->email = $request->main_email;
            $reservation->phone = $request->main_phone;
            $reservation->check_in = $request->check_in;
            $reservation->check_out = $request->check_out;
            $reservation->schedule_check_in = $request->schedule_check_in;
            $reservation->apartment_id = $request->apartment;

            $person = new Person();
            $person->name = $request->main_name;
            $person->document_type = $request->main_document_type;
            $person->document_nr = $request->main_document_nr;
            $person->document_serial_nr = $request->main_document_serial_nr;
            $person->nationality = $request->main_nationality;
            $person->document_picture = $main_photo;
            $person->reservation_id = $reservation->id;
            $person->save();
            $reservation->persons_id = $person->id;
            $reservation->save();


            $day = Carbon::parse($request->check_in);
            while ($day <= Carbon::parse($request->check_out)) {
                $ap = Apartment::where('id', $reservation->apartment_id)->first();
                $ap_prices = ApartmentCost::where('apartment_id', $ap->id)->where('check_in', '<=', $day)->where('check_out', '>=', $day)->first();

                if (!empty($ap_prices)) {
                    $reservation_price_list = new ReservationPriceList();
                    $reservation_price_list->name = 'Apartment price';
                    $reservation_price_list->price = $ap_prices->price;
                    $reservation_price_list->day = $day;
                    $reservation_price_list->reservation_id = $reservation->id;
                    $reservation_price_list->save();
                } else {
                    $reservation_price_list = new ReservationPriceList();
                    $reservation_price_list->name = 'Apartment price';
                    $reservation_price_list->price = $ap->price;
                    $reservation_price_list->day = $day;
                    $reservation_price_list->reservation_id = $reservation->id;
                    $reservation_price_list->save();
                }


                $ap_fees = ApartmentFee::where('apartment_id', $ap->id)->get();
                foreach ($ap_fees as $ap_fee) {
                    $reservatio_price_list = new ReservationPriceList();
                    $reservatio_price_list->name = $ap_fee->name;
                    $reservatio_price_list->price = $ap_fee->value;
                    $reservatio_price_list->value = $ap_fee->value;
                    $reservatio_price_list->description = $ap_fee->description;
                    $reservatio_price_list->type_of_value = $ap_fee->type_of_value;
                    $reservatio_price_list->day = $day;
                    $reservatio_price_list->reservation_id = $reservation->id;
                    $reservatio_price_list->save();
                }
                $day->addDays(1);
            }


            if ($request->client_name) {
                $this->validate($request, [
                    'client_name' => 'required|max:255',
                    'document_type' => 'required',
                    'document_nr' => 'required',
                    'document_serial_nr' => 'required',
                    'nationality' => 'required|max:255',
                    'image' => 'required',

                ]);
                if (count($request->document_type) != count($request->client_name)) {
                    return back()->with('error', 'You may choose only one type of ID');
                }
                $photo = \App\Http\Controllers\FilesController::uploadFile($request, 'image', 'document_photos', array("jpg", "jpeg", "png", "gif"), true);
                for ($i = 0; $i < count($request->client_name); $i++) {
                    $client = new Person();
                    $client->name = $request->client_name[$i];
                    $client->document_type = $request->document_type[$i][$i + 1];
                    $client->document_nr = $request->document_nr[$i];
                    $client->document_serial_nr = $request->document_serial_nr[$i];
                    $client->nationality = $request->nationality[$i];
                    $client->document_picture = $photo[$i];
                    $client->reservation_id = $reservation->id;
                    $client->save();


                }

            }
            return back()->with('success', 'The reservation has been saved successfully!');
        }
    }

    public function editReservations($id, Request $request)
    {

        $rules = [
            'main_name' => 'string|max:255',
            'main_nationality' => 'string|max:255',
            'main_email' => 'email',
            'main_phone' => 'digits_between:8,14',

        ];


        $this->validate($request, $rules);

        if (!empty($request->document_type)) {
            if (count($request->document_type) != count($request->client_name)) {
                return back()->with('error', 'You may choose only one type of ID');
            }
        }
        $reservations = Reservation::where('apartment_id', $request->apartment)->get();
        $ok = 1;
        $data = [];
        if ($reservations) {
            foreach ($reservations as $res) {
                if (($request->check_in >= $res->check_in && $request->check_in <= $res->check_out) ||
                    ($request->check_out >= $res->check_in && $request->check_out <= $res->check_out)
                ) {
                    $ok = 0;
                    $data['in'] = $res->check_in;
                    $data['out'] = $res->check_out;

                    break;
                }
            }
        }

        if ($ok === 0) {
            $date['in'] = Carbon::parse($data['in'])->format('m-d-Y');
            $date['out'] = Carbon::parse($data['out'])->format('m-d-Y');
            return back()->with('error', 'The apartment has been taken between ' . $date['in'] . ' and ' . $date['out']);
        }
        if(Carbon::parse($request->schedule_check_in)->toDateTimeString()<Carbon::parse($request->check_in)->toDateTimeString()){
            return back()->with('error', ' The Schedule check in may not be before the actuale check in!');

        }
        $reservation = Reservation::find($id);
            $reservation->check_in = $request->check_in;
            $reservation->check_out = $request->check_out;
        $reservation->schedule_check_in = $request->schedule_check_in;
        $reservation->name = $request->main_client_name;
        $reservation->email = $request->main_client_email;
        $reservation->phone = $request->main_client_phone;

        $reservation->apartment_id = $request->apartment;
        $reservation->save();
        $main_client = Person::where('id', $reservation->persons_id)->first();
        $main_client->name = $request->main_name;
        $main_client->document_type = $request->main_document_type;
        $main_client->document_nr = $request->main_document_nr;
        $main_client->document_serial_nr = $request->main_document_serial_nr;
        $main_client->nationality = $request->main_nationality;

        if ($request->main_profile_image) {
            $photo = \App\Http\Controllers\FilesController::uploadFile($request, 'main_profile_image', 'document_photos', array("jpg", "jpeg", "png", "gif"), false);
            $main_client->document_picture = $photo;
        }
        $main_client->save();


        $clients = Person::where('reservation_id', $id)->get();

        for ($i = 0; $i < count($clients); $i++) {

            $clients[$i]->name = $request->client_name[$i];
            $clients[$i]->document_type = $request->document_type[$i];
            $clients[$i]->document_nr = $request->client_document_nr[$i];
            $clients[$i]->document_serial_nr = $request->client_document_serial_nr[$i];
            $clients[$i]->nationality = $request->nationality[$i];
            $clients[$i]->reservation_id = $reservation->id;
            $clients[$i]->save();
        }


        return back()->with('success', 'The Reservation has been edited successfully!');
    }

    public function saveClientImage($id, Request $request)
    {

        $validator = Validator::make($request->all(), [

            'client_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $client = Person::where('id', $id)->first();

        if ($validator->passes()) {

            $client_photo = \App\Http\Controllers\FilesController::uploadFile($request, 'client_image', 'document_photos', array("jpg", "jpeg", "png", "gif"), false);
            $client->document_picture = $client_photo;
            $client->save();

            return back()->with('success', 'Profile Image of the client has been updated');
        }


        return back()->with('error', 'Something went wrong please try again');
    }

    public function deleteReservation($id)
    {

        Reservation::find($id)->delete();

        return back()->with('success', 'Reservation has been deleted successfully!');
    }

    public function pdfGenerator($id)
    {
        $reservation = Reservation::where('id', $id)->first();
        $pdf = PDF::loadView('admin.pdf.invoice', array('reservation' => $reservation));
        // return view('admin.pdf.invoice', array('reservation'=>$reservation));
        return $pdf->download('invoice.pdf');
    }

    public function deleteCloneClient($id)
    {
        Person::find($id)->delete();
    }

    public function cloneReservation($id, Request $request)
    {


        if (!empty($request->document_type)) {
            if (count($request->document_type) != count($request->client_name)) {
                return back()->with('error', 'You may choose only one type of ID');
            }
        }
        $reservations = Reservation::where('apartment_id', $request->apartment)->get();
        $ok = 1;
        $data = [];
        if ($reservations) {
            foreach ($reservations as $res) {
                if (($request->check_in >= $res->check_in && $request->check_in <= $res->check_out) ||
                    ($request->check_out >= $res->check_in && $request->check_out <= $res->check_out)
                ) {
                    $ok = 0;
                    $data['in'] = $res->check_in;
                    $data['out'] = $res->check_out;

                    break;
                }
            }
        }

        if ($ok === 0) {
            $date['in'] = Carbon::parse($data['in'])->toDateString();
            $date['out'] = Carbon::parse($data['out'])->toDateString();
            return back()->with('error', 'The apartment has been taken between ' . $data['in'] . ' and ' . $data['out']);
        }
        $reservation = Reservation::find($id);

        $clone_reservation = new Reservation();


        if (empty($request->check_in) || empty($request->check_out)) {
            return back()->with('error', 'You have to enter a check in and a check out date!');

        } else if ($request->check_in > $request->check_out || $request->check_in < Carbon::today()) {
            return back()->with('error', 'You have to enter a date that is valid !');

        } else {
            $clone_reservation->check_in = $request->check_in;
            $clone_reservation->check_out = $request->check_out;
        }

        $clone_reservation->name = $reservation->name;
        $clone_reservation->email = $reservation->email;
        $clone_reservation->phone = $reservation->phone;
        $clone_reservation->apartment_id = $reservation->apartment_id;
        $clone_reservation->languages_id = $reservation->languages_id;
        $clone_reservation->persons_id = $reservation->persons_id;
        $clone_reservation->save();
        if (count($request->client_name) != count($request->document_type)
            || count($request->client_name) != count($request->client_document_nr) ||
            count($request->client_name) != count($request->client_document_serial_nr) ||
            count($request->client_name) != count($request->nationality)

        ) {
            return back()->with('error', 'All fields are mandatory for secondary clients !');

        }

        for ($i = 0; $i < count($request->client_name); $i++) {
            $second_client = Person::find($request->client_id[$i]);
            $client = new Person();
            $client->document_picture = $second_client->document_picture;
            $client->name = $request->client_name[$i];
            $client->document_type = $request->document_type[$i];
            $client->document_nr = $request->client_document_nr[$i];
            $client->document_serial_nr = $request->client_document_serial_nr[$i];
            $client->nationality = $request->nationality[$i];
            $client->reservation_id = $clone_reservation->id;
            $client->save();
        }
        if (!empty($request->new_client_name)) {
            if (count($request->new_client_name) != count($request->new_document_type)
                || count($request->new_client_name) != count($request->new_client_document_nr) ||
                count($request->new_client_name) != count($request->new_client_document_serial_nr) ||
                count($request->new_client_name) != count($request->new_nationality) ||
                count($request->new_client_name) != count($request->new_client_photo)
            ) {
                return back()->with('error', 'All fields are mandatory for secondary clients !');

            }
            $photos = \App\Http\Controllers\FilesController::uploadFile($request, 'new_client_photo', 'document_photos', array("jpg", "jpeg", "png", "gif"), true);
            for ($i = 0; $i < count($request->new_client_name); $i++) {
                dd($request);
                $client = new Person();

                $client->name = $request->new_client_name[$i];
                $client->document_type = $request->new_document_type[$i];
                $client->document_nr = $request->new_client_document_nr[$i];
                $client->document_serial_nr = $request->new_client_document_serial_nr[$i];
                $client->nationality = $request->new_nationality[$i];
                $client->reservation_id = $clone_reservation->id;
                $client->document_picture = $photos[$i];
                $client->save();
            }
        }
        return back()->with('success', 'Reservation cloned successfully!');
    }


    public function search(Request $request)

    {
                $reservations=[];
        if ($request) {
            $reservations = Reservation::where('name', 'LIKE', '%' . $request->name . "%")
                ->where('phone', 'LIKE', '%' . $request->phone . "%")
                ->where('email', 'LIKE', '%' . $request->email . "%")

                ->orderBy('id')->get();
        }
        $result=[];
        if($request->check_in && $request->check_out){
            foreach ($reservations as $res){
                if($res->check_in>Carbon::parse($request->check_in)->toDateString() &&
                    $res->check_out<Carbon::parse($request->check_out)->toDateString()
                ){
                    array_push($result,$res);
                }
            }
            $reservations=$result;
        }elseif($request->check_in){
            foreach ($reservations as $res){
                if($res->check_in>Carbon::parse($request->check_in)->toDateString()){
                    array_push($result,$res);
                }
            }
            $reservations=$result;
        }elseif($request->check_out){
            foreach ($reservations as $res){
                if($res->check_out<Carbon::parse($request->check_out)->toDateString()){
                    array_push($result,$res);
                }
            }
            $reservations=$result;
        }

                  return view('admin.reservations', compact('reservations'))->with('success', 'The results of the search are');
    }

    public function selectCaretaker($id, Request $request){

            $reservation=Reservation::find($id);
            $reservation->caretaker_id=$request->caretaker;
                $reservation->save();

                return back()->with('success', 'Caretaker added successfully');
    }

    public function pdfGeneratorTenancy($language, $id)
    {
        if($language==='spanish'){
            $reservation = Reservation::where('id', $id)->first();

            $apartment=Apartment::where('id', $reservation->apartment_id)->first();
            $client=Person::where('id', $reservation->persons_id)->first();
            return view('admin.pdf.spanish_tenancy', array('client'=>$client,'apartment'=>$apartment,'reservation'=>$reservation));
            $pdf = PDF::loadView('admin.pdf.spanish_tenancy', array('reservation' => $reservation,));
            return $pdf->download('invoice.pdf');
        }elseif ($language==='english'){
            $reservation = Reservation::where('id', $id)->first();
            $pdf = PDF::loadView('admin.pdf.spanish_english', array('reservation' => $reservation));
        }

    }

}
