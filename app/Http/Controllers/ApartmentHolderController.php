<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\ApartmentHolder;
use Illuminate\Http\Request;

class ApartmentHolderController extends Controller
{
    public function showHolders(){
            $holders=ApartmentHolder::all();
        return view('admin.holders', array('holders'=>$holders));
    }

    public function addHolder(Request $request){

        $this->validate($request,[
           'name'=>'required|string|max:255',
            'address'=>'required|string|max:20000',
            'email'=>'required|email',
            'phone'=>'required|numeric',

        ]);


        $holder=new ApartmentHolder();
        $holder->name=$request->name;
        $holder->address=$request->address;
        $holder->email=$request->email;
        $holder->phone=$request->phone;
        if($request->cnp) {
            $rules=[
                'cnp'=>'numeric|digits:13'
                ];

            $customMsg=[
              'digits'=>'If you enter CNP it has to have exactly 13 digits'
            ];

            $this->validate($request, $rules, $customMsg);
            $holder->cnp = $request->cnp;
        }else{
            $holder->cnp =NULL;
        }
        if($request->document_photo) {
            $photo = \App\Http\Controllers\FilesController::uploadFile($request, 'document_photo', 'apartment_holders', array("jpg", "jpeg", "png", "gif"), false);
            $holder->document_photo=$photo;
        }else{
            $holder->document_photo=NULL;
        }
        $holder->save();

        foreach ($request->apartments as $ap){
            $apartment=Apartment::find($ap);
            $apartment->holder_id=$holder->id;
            $apartment->save();
        }

        return back()->with('success', 'A new holder has been added');
    }

    public function deleteHolder($id){

        ApartmentHolder::find($id)->delete();

        return back()->with('success', 'Holder has been deleted successfully');
    }
}
