<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\ApartmentFeature;
use App\Feature;
use App\Picture;
use Illuminate\Http\Request;
use App\Http\Controllers\FilesController;
class ApartmentsController extends Controller
{
    public function showApartmentsTable(){
        $features=Feature::all();
        return view('admin.apartments', array('features'=>$features));
    }

    public function addApartment( Request $request){

        $this->validate($request ,[
                'lat'=>'required',
                'lng'=>'required',
                'address'=>'required|string|max:2000',
                    'stars'=>'required',
                    'surface'=>'required|numeric',
                'description'=>'required|max:200000',
            'price'=>'required|numeric',
            'increment_price'=>'required|numeric',
            'price_type'=>'required'
        ]);
        $apartment=new Apartment();
        $apartment->lat=$request->lat;
        $apartment->lng=$request->lng;
        $apartment->location=$request->address;
        $apartment->description=$request->description;
        $apartment->stars=$request->stars;
        $apartment->price=$request->price;
        $apartment->increment_price=$request->increment_price;
        $apartment->kind_increment_price=$request->price_type;
        $apartment->save();
        if($request->features){
            foreach ($request->features as $feature) {
                $apartment_feature = new ApartmentFeature();
                $apartment_feature->apartments_id = $apartment->id;
                $apartment_feature->features_id = $feature;
                $apartment_feature->save();
            }
        }else{
            return back()->with('error','You need to choose at least one feature');
        }

        if($request->apartment_photos){
          $photos=\App\Http\Controllers\FilesController::uploadFile($request,'apartment_photos','apartments_photos',array("jpg", "jpeg", "png", "gif"),true);
          foreach ($photos as $photo){
                $picture=new Picture();
                $picture->filename=$photo;
                $picture->apartments_id=$apartment->id;
                $picture->save();
            }
        }else{
            return back()->with('error','You need to add  at least one photo for the apartment');

        }

        return back()->with('success','Apartment has been saved successfully!');

    }



}
