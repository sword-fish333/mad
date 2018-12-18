<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\ApartmentFeature;
use App\ApartmentFee;
use App\ApartmentHolder;
use App\Feature;
use App\Picture;
use Illuminate\Http\Request;
use App\Http\Controllers\FilesController;
class ApartmentsController extends Controller
{
    public function showApartmentsTable()
    {
        $features = Feature::all();
        $apartments = Apartment::all();

        return view('admin.apartments', array('apartments' => $apartments, 'features' => $features));
    }

    public function addApartment(Request $request)
    {

        $this->validate($request, [
            'lat' => 'required',
            'lng' => 'required',
            'address' => 'required|string|max:2000',
            'stars' => 'required',
            'surface' => 'required|numeric',
            'description' => 'required|max:200000',
            'price' => 'required|numeric',
            'increment_price' => 'required|numeric',
            'price_type' => 'required',

        ]);
        $apartment = new Apartment();
        $apartment->lat = $request->lat;
        $apartment->lng = $request->lng;
        $apartment->location = $request->address;
        $apartment->description = $request->description;
        $apartment->stars = $request->stars;
        $apartment->price = $request->price;
        $apartment->surface = $request->surface;
        $apartment->increment_price = $request->increment_price;
        $apartment->kind_increment_price = $request->price_type;



        if(!empty($request->holder_name) && !empty($request->holder)){

            return back()->with('error','You can not choose a holder and enter one at the same time!');
        }else if(!empty($request->holder_name)){
            $this->validate($request,[
                'holder_name'=>'required|string|max:255',
                'holder_address'=>'required|string|max:20000',
                'holder_email'=>'required|email',
                'holder_phone'=>'required|numeric'
            ]);

            $holder=new ApartmentHolder();
            $holder->name=$request->holder_name;
            $holder->address=$request->holder_address;
            $holder->email=$request->holder_email;
            $holder->phone=$request->holder_phone;
            $holder->save();
            $apartment->holder_id=$holder->id;
        }else if(!empty($request->holder)) {
            $apartment->holder_id=$request->holder;
        }else{
            $apartment->holder_id=NULL;
        }


        $apartment->save();

        if(!empty($request->fee_name)) {


            if (count($request->fee_name) != count($request->fee_description) || count($request->fee_name) != count($request->fee_value) || count($request->fee_name) != count($request->type_of_value)) {
                return back()->with('error', 'You have to complete all fields for a new fee');
            }

            for($i=0; $i<count($request->fee_name);$i++) {
                $apartment_fee = new ApartmentFee();
                $apartment_fee->name = $request->fee_name[$i];
                $apartment_fee->description = $request->fee_description[$i];
                $apartment_fee->value = $request->fee_value[$i];
                $apartment_fee->type_of_value = $request->type_of_value[$i][$i+1];
                $apartment_fee->apartment_id = $apartment->id;
                $apartment_fee->save();
            }

        }
        if ($request->features) {
            foreach ($request->features as $feature) {
                $apartment_feature = new ApartmentFeature();
                $apartment_feature->apartments_id = $apartment->id;
                $apartment_feature->features_id = $feature;
                $apartment_feature->save();
            }
        } else {
            return back()->with('error', 'You need to choose at least one feature');
        }

        if ($request->apartment_photos) {
            $photos = \App\Http\Controllers\FilesController::uploadFile($request, 'apartment_photos', 'apartments_photos', array("jpg", "jpeg", "png", "gif"), true);
            foreach ($photos as $photo) {
                $picture = new Picture();
                $picture->filename = $photo;
                $picture->apartments_id = $apartment->id;
                $picture->save();
            }
        } else {
            return back()->with('error', 'You need to add  at least one photo for the apartment');

        }

        return back()->with('success', 'Apartment has been saved successfully!');

    }

    public function editApartment($id, Request $request)
    {
        $this->validate($request, [
            'lat_2' => 'required',
            'lng_2' => 'required',
            'address' => 'required|string|max:2000',
            'edit_stars' => 'required',
            'surface' => 'required|numeric',
            'description' => 'required|max:200000',
            'price' => 'required|numeric',
            'increment_price' => 'required|numeric',
            'price_type' => 'required'
        ]);
        $apartment = Apartment::find($id);
        $apartment->surface = $request->surface;
        $apartment->location = $request->address;
        $apartment->lat = $request->lat_2;
        $apartment->lng = $request->lng_2;
        $apartment->description = $request->description;
        $apartment->price = $request->price;
        $apartment->stars=$request->edit_stars;
        $apartment->increment_price = $request->increment_price;
        $apartment->kind_increment_price = $request->price_type;


        if(!empty($request->holder_name) && !empty($request->holder)){

            return back()->with('error','You can not choose a holder and enter one at the same time!');
        }
        else if(!empty($request->holder_name)){
            $this->validate($request,[
                'holder_name'=>'required|string|max:255',
                'holder_address'=>'required|string|max:20000',
                'holder_email'=>'required|email',
                'holder_phone'=>'required|numeric'
            ]);

            $holder=new ApartmentHolder();
            $holder->name=$request->holder_name;
            $holder->address=$request->holder_address;
            $holder->email=$request->holder_email;
            $holder->phone=$request->holder_phone;
            $holder->save();
            $apartment->holder_id=$holder->id;
        }else if(!empty($request->holder)) {
            $apartment->holder_id=$request->holder;
        }else{
            $apartment->holder_id=NULL;
        }


        $apartment->save();

        ApartmentFeature::where('apartments_id', $apartment->id)->delete();
        if ($request->new_features) {
            foreach ($request->new_features as $feature) {
                $apartment_feature = new ApartmentFeature();
                $apartment_feature->apartments_id = $apartment->id;
                $apartment_feature->features_id = $feature;
                $apartment_feature->save();
            }
        } else {
            return back()->with('error', ' You have to select at least one feature!');
        }

        if ($request->apartment_photos) {
            $photos = \App\Http\Controllers\FilesController::uploadFile($request, 'apartment_photos', 'apartments_photos', array("jpg", "jpeg", "png", "gif"), true);
            foreach ($photos as $photo) {
                $picture = new Picture();
                $picture->filename = $photo;
                $picture->apartments_id = $apartment->id;
                $picture->save();
            }
        }
        return back()->with('success', 'The Apartment has been edited successfully!');
    }

    public function deleteApartmentEditPhoto($id){
        Picture::find($id)->delete();
    }

    public function deleteApartment($id){
        Apartment::find($id)->delete();
        ApartmentFeature::where('apartments_id', $id)->delete();
        Picture::where('apartments_id', $id)->delete();

        return back()->with('success','Apartment and related data have beeen deleted successfully!');
    }

    public function addFee($id, Request $request){


        $booking_fee=new ApartmentFee();
        $booking_fee->name=$request->name;
        $booking_fee->description=$request->description;
        $booking_fee->value=$request->value;
        $booking_fee->type_of_value=$request->type_of_value;
        $booking_fee->apartment_id=$id;
        $booking_fee->save();


        return back()->with('success', 'Fee for reservation as been saved successfully!');
    }

    public function viewFees($id){
        $apartment_fees=ApartmentFee::where('apartment_id',$id)->get();
        $apartment_fees=json_encode($apartment_fees);
        return $apartment_fees;
    }

    public function deleteFee($id){

        ApartmentFee::find($id)->delete();
    }
}
