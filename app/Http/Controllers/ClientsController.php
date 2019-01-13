<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Blog;
use App\Offer;
use Carbon\Carbon;
use foo\bar;
use Illuminate\Http\Request;

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
        $blogs = Blog::all();
        return view('client.blog', array('blogs' => $blogs));
    }

    public function viewForm()
    {
        return view('client.reservation');
    }

    public function searchApartments(Request $request)
    {
        $this->validate($request,[
        'check_in'=>'required|date',
        'check_out'=>'required|date',
            'persons_nr'=>'integer|min:0|nullable'
    ]);
        if (Carbon::parse($request->check_in) < Carbon::now() || Carbon::parse($request->check_out) <= Carbon::parse($request->check_in)) {
            return back()->with('error', 'You have entered a wrong date format. The check out can not be before the check in and the check in can not be before today ! Please try again ');
        }
        $apartments = Apartment::where('status','!=', 'blocked')->orWhereNull('status')->paginate(5);

        if(!$request->persons_nr){
            $nr_p=1;
        }else{
            $nr_p=$request->persons_nr;
        }

        return view('client.search_results', array('apartments' => $apartments, 'check_in' => $request->check_in, 'check_out' => $request->check_out, 'nr_persons'=>$nr_p));
    }
}
