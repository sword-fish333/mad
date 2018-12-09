<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApartmentsController extends Controller
{
    public function showApartmentsTable(){

        return view('admin.apartments');
    }
}
