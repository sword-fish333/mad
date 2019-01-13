<?php

namespace App\Http\Controllers;

use App\Apartment;
use App\Blog;
use App\Offer;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index(){
        $apartment=Apartment::all();
        $blogs=Blog::all();
        $offers=Offer::orderBy('created_at','DESC')->get();
        return view('client.index', array('apartments'=>$apartment, 'blogs'=>$blogs, 'offers'=>$offers));
    }
    public function viewSinglePost($id){
        $blog=Blog::find($id);
        return view('client.single_blog', array('blog'=>$blog));
    }

    public function allPosts(){
        $blogs=Blog::all();
        return view('client.blog', array('blogs'=>$blogs));
    }
}
