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
            'phone'=>'required|numeric'
        ]);

        $holder=new ApartmentHolder();
        $holder->name=$request->name;
        $holder->address=$request->address;
        $holder->email=$request->email;
        $holder->phone=$request->phone;
        $holder->save();

        foreach ($request->apartments as $ap){
            $apartment=Apartment::find($ap);
            $apartment->holder_id=$holder->id;
            $apartment->save();
        }

        return back()->with('success', 'A new holder has been added');
    }
}
