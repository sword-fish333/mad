<?php

namespace App\Http\Controllers;

use App\Offer;
use Illuminate\Http\Request;

class OffersController extends Controller
{
    public function index()
    {
        $offers = Offer::orderBy('created_at','DESC')->get();
        return view('admin.offers', array('offers' => $offers));
    }

    public function addOffer(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description'=>'required|string|max:20000',

            'link' => 'required|url'
        ]);
        if(!$request->free_discount  && !$request->discount){
            return back()->with('error','You must enter a value or choose free for the discount!');
        }
        $nr_discount=(double)$request->discount;
        if($request->discount && $nr_discount<0){
            return back()->with('error','You must enter a valid value for the discount!');
        }


        $offer = new Offer();
        $offer->name = $request->name;
        $offer->description = $request->description;
        if($request->free_discount){
            $offer->discount = $request->free_discount;

        }else {
            $offer->discount = $request->discount;
        }
        $offer->restaurant_url = $request->link;
        if ($request->image) {
            $photo = \App\Http\Controllers\FilesController::uploadFile($request, "image", "offers_images", array("jpg", "jpeg", "png", "gif"), false);
            $offer->image = $photo;
        }

        $offer->save();
        return back()->with('success', 'Offer saved successfully!');
    }

    public function editOffer($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'string|max:255',
            'description' => 'string|max:20000',

        ]);
        if(!$request->free_discount  && !$request->discount){
            return back()->with('error','You must enter a value or choose free for the discount!');
        }
        $nr_discount=(double)$request->discount;
        if($request->discount && $nr_discount<0){
            return back()->with('error','You must enter a valid value for the discount!');
        }

        $offer = Offer::find($id);
        $offer->name = $request->name;
        $offer->description = $request->description;
        if($request->free_discount){
            $offer->discount = $request->free_discount;

        }else {
            $offer->discount = $request->discount;
        }
        if ($request->image) {
            $photo = \App\Http\Controllers\FilesController::uploadFile($request, "image", "offers_images", array("jpg", "jpeg", "png", "gif"), false);
            $offer->image = $photo;
        }

        $offer->save();
        return back()->with('success', 'Offer has been edited successfully!');
    }


    public function deleteOffer($id){
        Offer::find($id)->delete();

        return back()->with('success', 'Offer was deleted successfully!');
    }
}
