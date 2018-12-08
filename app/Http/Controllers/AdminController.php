<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class AdminController extends Controller
{
    function showLogin(){

        return view('admin.login');
    }
    function showRegister(){

        return view('admin.register');
    }


    public function adminLogin(Request $request){
        $user=Admin::where("email","=",$request->email)->get();
        if(count($user)!=1){
            Session::flash("error","Admin is not a valid account!");
            return back();
        }

        if(password_verify($request->password,$user[0]->password)!==true){
            Session::flash("error","Invalid Password!");
            return back();
        }

        Session::put("user",$user[0]);
        Session::put("ok",1);
        Session::put("is_admin",1);
        return back()->with('success','You are now logedin!');
    }

    function adminRegister(Request $request){
        $this->validate(request(), [
            'name' => 'required|min:2|max:255',
            'email' => 'required|email|max:255',
            'phone'=>'required|numeric|digits_between:8,14',
            'password' => 'min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'min:6'
        ]);

        $admin =new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->password=Hash::make($request->password);
        $admin->save();

        return redirect()->to('/login')->with('success','You are registered');

    }

    function logout(){
        Session::flush();
        return redirect('admin/login');
    }

}
