<?php

namespace App\Http\Controllers;

use App\Feature;
use Illuminate\Http\Request;

class FeaturesController extends Controller
{
    public function showFeatures(){
        $features=Feature::paginate(10);
        return view('admin.features', array('features'=>$features));
    }

    public function addFeature(Request $request){
        $this->validate($request,[
           'name'=>'required|max:2000',
            'icon'=>'required'
        ]);

        $feature=new Feature();
        $feature->name=$request->name;
        $photo = \App\Http\Controllers\FilesController::uploadFile($request, 'icon', 'features_images', array("jpg", "jpeg", "png", "gif"));
        $feature->icon=$photo;
        $feature->save();

        return back()->with('success','Feature added successfully!');

    }

    public function editFeature($id,Request $request){
        $this->validate($request,[
            'name'=>'max:2000',

        ]);

        $feature=Feature::find($id);
        $feature->name=$request->name;
        if($request->icon) {
            $photo = \App\Http\Controllers\FilesController::uploadFile($request, 'icon', 'features_images', array("jpg", "jpeg", "png", "gif"));
            $feature->icon = $photo;
        }
        $feature->save();

        return back()->with('success','Feature edited successfully!');

    }

    public function deleteFeature($id){
        Feature::find($id)->delete();

        return back()->with('success',' Feature has been deleted successfully!');
    }
}
