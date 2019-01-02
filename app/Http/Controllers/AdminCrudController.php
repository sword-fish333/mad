<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
class AdminCrudController extends Controller
{
    public function index(){
            $admins=Admin::all();
        return view('admin.admins_table', compact('admins'));
    }

    public function add(Request $request){
        $this->validate(request(), [
            'name' => 'required|min:2|max:255|unique:admins',
            'email' => 'required|email|max:255|unique:admins',
            'phone'=>'required|numeric|digits_between:8,14',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6',
            'current_password'=>'required'
        ]);


       if(password_verify($request->current_password, Session::get('user')->password)!==true){
           return back()->with('error', 'Password does not match the current admin logged in!');
       }

       $ad=new Admin();
       $ad->name=$request->name;
        $ad->email=$request->email;
        $ad->phone=$request->phone;
        $ad->password=Hash::make($request->password);
        $ad->save();

        return back()->with('success', 'Admin has been added successfully!');
    }

    public function edit($id , Request $request){
        $this->validate(request(), [
            'name' => 'nullable|min:2|max:255',
            'email' => 'nullable|email|max:255',
            'phone'=>'required|numeric|digits_between:8,14',
            'password' => 'nullable|min:6|same:confirm_password',
            'confirm_password' => 'nullable|min:6',
            'current_password'=>'required'
        ]);
        if(password_verify($request->current_password, Session::get('user')->password)!==true){
            return back()->with('error', 'Password does not match the current admin logged in!');
        }
        $ad=Admin::find($id);
        $ad->name=$request->name;
        $ad->email=$request->email;
        $ad->phone=$request->phone;
        $ad->password=Hash::make($request->password);
        $ad->save();

        return back()->with('success','Admin edited successfully!');
    }

    public function delete($id){
        Admin::find($id)->delete();

        return back()->with('success','Admin deleted successfully!');
    }
}
