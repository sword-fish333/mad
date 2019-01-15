<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Blog;
use App\Country;
use App\Language;
use App\Newsletter;
use App\Offer;
use Carbon\Carbon;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ClientsController extends Controller
{
    public function index()
    {
        $apartment = Apartment::all();
        $blogs = Blog::all();
        $offers = Offer::orderBy('created_at', 'DESC')->get();
        return view('client.index', array('apartments' => $apartment, 'blogs' => $blogs, 'offers' => $offers));
    }

    public function viewSinglePost($id)
    {
        $blog = Blog::find($id);
        return view('client.single_blog', array('blog' => $blog));
    }

    public function allPosts()
    {
        $articles = Blog::paginate(5);
        return view('client.blog', array('articles' => $articles));
    }

    public function viewForm()
    {
        return view('client.reservation');
    }

    public function searchApartments(Request $request)
    {
        $this->validate($request, [
            'check_in' => 'required|date',
            'check_out' => 'required|date',
            'persons_nr' => 'integer|min:0|nullable'
        ]);
        if (Carbon::parse($request->check_in) < Carbon::now() || Carbon::parse($request->check_out) <= Carbon::parse($request->check_in)) {
            return back()->with('error', 'You have entered a wrong date format. The check out can not be before the check in and the check in can not be before today ! Please try again. ');
        }
        $apartments = Apartment::where('status', '!=', 'blocked')->orWhereNull('status')->paginate(5);

        if (!$request->persons_nr) {
            $nr_p = 1;
        } else {
            $nr_p = $request->persons_nr;
        }

        return view('client.search_results', array('apartments' => $apartments, 'check_in' => $request->check_in, 'check_out' => $request->check_out, 'nr_persons' => $nr_p));
    }

    public function viewApartment($id)
    {
        $apartment = Apartment::find($id);

        return view('client.apartment_info', array('apartment' => $apartment));
    }

    public function viewReservation($id)
    {
        $apartment = Apartment::find($id);
        $languages = Language::all();
        $countries = Country::all();
        return view('client.reservation', array('apartment' => $apartment, 'languages' => $languages, 'countries' => $countries));
    }

    public function viewContact(){
        return view('client.contact');
    }

    public function sendMail(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:2000',
            'email' => 'required|email',
            'newsletter' => 'integer|min:0|nullable',
            'message'=>'required|string|max:2000'
        ]);
        if($request->newsletter==1){
            $newsletter=new Newsletter();
            $newsletter->name=$request->name;
            $newsletter->email=$request->email;
            $newsletter->save();
        }
        $to_name = $request->name;
        $to_email = $request->email;
        $data=array('client_name'=>$request->name,'client_email'=>$request->email,'newsletter'=>$request->newsletter, 'text'=>$request->message);
        Mail::send('client.mail.client_mail', $data, function ($message) use($to_name,$to_email) {
            $message->to('ghiurcaalin@gmail.com')
                ->subject('client mail');
            $message->from( $to_email);
        });
        if (Mail::failures()) {

            return back()->with('error','Mail could not be sent. Please try again');
        }

        return back()->with('success','Mail was sent successfully');
    }


}
