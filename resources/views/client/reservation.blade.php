@extends('client.layouts.master')
@section('content')
    <div class="header_title_blue">
        <div class="inner_titl">
            <p class="text_title">Make a reservation for the Apartment &nbsp; <i class="fas fa-check"></i></p>
        </div>
    </div>

    <div class="content_w_title">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p class="blog_text"><span
                                style="color:#0b0c9a"><b>Name of the Apartment: </b></span>{{$apartment->name}}</p>
                    @include('admin.parts.messages.success')
                    @include('admin.parts.messages.error')
                    @include('admin.parts.messages.custom_error')
                    <form action="/clients/new/reservation/{{$apartment->id}}" method="post" id="reservation_form">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" class="input_form" name="guests_nr" value="{{old('guests_nr')}}"
                                       placeholder="Nr. of persons...">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="input_form datepicker" value="{{old('check_in')}}"
                                       name="check_in" autocomplete="off"
                                       placeholder="Data check-in...">
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="input_form datepicker" value="{{old('check_out')}}"
                                       name="check_out" autocomplete="off"
                                       placeholder="Data check-out...">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" class="input_form" value="{{old('name')}}" name="name"
                                       placeholder="First and Second name...">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="label_doc_type">Type of document:</label>
                                <input type="radio" class="ml-3"  name="document_type"
                                       value="id_card">&nbsp; <b class="doc_type">ID Card</b>
                                <input type="radio" style="margin-left: 15px;" name="document_type"
                                       value="passport">&nbsp; <b class="doc_type">Passport</b><br>
                                <input type="radio" style="margin-left: 120px;" name="document_type"
                                       value="other">&nbsp; <b class="doc_type">Other</b>
                            </div>
                            <div class="col-md-6">

                                <input type="text" class="input_form" name="email" value="{{old('email')}}"
                                       placeholder="Email...">
                            </div>


                            <div class="col-md-6">
                                <input type="text" class="input_form" name="phone" value="{{old('phone')}}"
                                       placeholder="Phone...">
                            </div>
                            <div class="col-md-6 ">
                                <input type="text" class="input_form" name="nr_document" value="{{old('nr_document')}}"
                                       placeholder="Nr. CI/Pasaport">
                            </div>

                            <div class="col-md-6">
                                <input type="text" class="input_form" value="{{old('seria_document')}}"
                                       name="seria_document"
                                       placeholder="Series CI/Pasaport">
                            </div>


                            <div class="col-md-6">
                                <select class="input_form custom_input" name="language">
                                    <option selected="selected">Select Language</option>
                                    @foreach($languages as $language)
                                        <option value="{{$language->id}}">{{$language->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="input_form  custom_input" name="nationality">
                                    <option selected="selected">Select Nationality</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country->num_code}}">{{$country->nationality}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <p class="form_info">You do not have to enter information for the <span
                                            style="color: darkred">Series for the document</span> but the <span
                                            style="color: darkred">Number of the document </span> has to <span
                                            style="color: darkred">have</span> a value!</p>
                                <input type="checkbox" class="check_th" name="terms" value="1"/>
                                <p class="loc_ttt check_th">I agree with the terms and conditions of MadreamsRent</p><br>
                                <input type="checkbox" class="check_th" name="newsletter" value="1"/>
                                <p class="loc_ttt check_th">I want to subscribe to the MadreamsRent newsletter</p>
                                <br><br>
                                <a id="book"><p class="book_btn">Book <i class="fas fa-angle-right"></i></p></a>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-4 mt-3">
                    <div class="infor_div">

                        <p class="text_ann ml-4"><i class="fas fa-exclamation-circle art_sign"></i>
                            Accommodation after 10 pm+ <b>30 euro</b></p>
                    </div>
                    <div class="infor_div">

                        <p class="text_ann ml-4"><i class="fas fa-exclamation-circle art_sign "></i>
                            In order to receive the money back, cancellations are made at least 7 days in advance</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#book').click(function (e) {
            e.preventDefault();
            $('#reservation_form').submit();
        });


    </script>
@endsection