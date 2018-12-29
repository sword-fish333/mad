<?php

namespace App\Http\Controllers;

use App\Admin;
use App\Apartment;
use App\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class AdminController extends Controller
{
   public function showLogin(){

        return view('admin.login');
    }
    public   function showRegister(){

        return view('admin.register');
    }

    function showDashboard(){
            $reservations_in=Reservation::where('check_in','>=',Carbon::today())->where('check_in','<=',Carbon::today()->addDays(5))->get();
              $reservations_out=Reservation::where('check_out','>=',Carbon::today())->where('check_out','<=',Carbon::today()->addDays(5))->get();
        return view('admin.admin_dashboard',array( 'reservations_in'=>$reservations_in, 'reservations_out'=>$reservations_out));
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
        return redirect('/admin/dashboard')->with('success','You are now logged in!');
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

        return redirect()->to('admin/login')->with('success','You are registered');

    }

    function Logout(){
        Session::flush();
        return redirect('admin/login')->with('success','You are now logged out');
    }

}
