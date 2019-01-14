@extends('client.layouts.master')
@section('content')
    <div class="header_title_blue">
        <div class="inner_titl">
            <p class="text_title">Make a reservation for the Apartment  &nbsp; <i class="fas fa-check"></i></p>
        </div>
    </div>

    <div class="content_w_title">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p class="blog_text"><span style="color:#0b0c9a"><b>Name of the Apartment: </b></span>{{$apartment->name}}</p>
                    @include('admin.parts.messages.success')
                    @include('admin.parts.messages.error')
                    @include('admin.parts.messages.custom_error')
                    <form action="/clients/new/reservation" method="post" id="reservation_form">
                        @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" class="input_form" name="nr_persons" placeholder="Nr. of persons...">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="input_form datepicker" name="check_in" autocomplete="off" placeholder="Data check-in...">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="input_form datepicker" name="check_out" autocomplete="off" placeholder="Data check-out...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="input_form" placeholder="First and Second name...">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="input_form" name="email" placeholder="Email...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="input_form"  name="phone" placeholder="Phone...">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="input_form" name="nr_document" placeholder="Nr. CI/Pasaport">
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <input type="text" class="input_form" name="seria_document" placeholder="Seria CI/Pasaport">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <select class="input_form">
                                <option selected="selected">Selecteaza limba</option>
                                @foreach($languages as $language)
                                <option>{{$language->name}}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="input_form">
                                <option selected="selected">Select Nationality</option>
                                @foreach($countries as $country)
                                <option>{{$country->nationality}}</option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <p class="form_info">You do not have to enter information for both the <span style="color: darkred">Nr of the Document</span> and the <span style="color: darkred">Series for the document</span> but one of them <span style="color: darkred">must be completed</span></p>
                            <input type="checkbox" class="check_th" name="terms" value="1"/>
                            <p class="loc_ttt check_th">Sunt de acord cu termenii si conditiile MadreamsRent</p><br>
                            <input type="checkbox" class="check_th" name="newsletter" value="newsletter"/>
                            <p class="loc_ttt check_th">Doresc sa fiu abonat la newsletterul MadreamsRent</p><br><br>
                            <a id="book"><p class="book_btn">Book <i class="fas fa-angle-right"></i></p></a>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="infor_div">
                        <i class="fas fa-exclamation-circle art_sign"></i>
                        <p class="text_ann">Cazare dupa 10 noaptea + <b>30 euro</b></p>
                    </div>
                    <div class="infor_div">
                        <i class="fas fa-exclamation-circle art_sign"></i>
                        <p class="text_ann">Pentru a primi banii inapoi, anularea se face cu minim 7 zile inainte</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#book').click(function(e) {
            e.preventDefault();
            $('#reservation_form').submit();
        });
    </script>
    @endsection