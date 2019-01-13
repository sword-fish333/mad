@extends('client.layouts.master')
@section('content')
    <div class="header_title_blue">
        <div class="inner_titl">
            <p class="text_title">Reservation Form</p>
        </div>
    </div>

    <div class="content_w_title">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p class="blog_text"><span style="color:#0b0c9a"><b>Nume apartament: </b></span> Nume apartament lorem ipsum dolor sit amen.</p>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" class="input_form" placeholder="Nr. persoane...">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="input_form" placeholder="Data check-in...">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="input_form" placeholder="Data check-out...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="input_form" placeholder="Nume si prenume...">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="input_form" placeholder="Email...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" class="input_form" placeholder="Telefon...">
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="input_form" placeholder="Nr. CI/Pasaport">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <select class="input_form">
                                <option selected="selected">Selecteaza limba</option>
                                <option>Romana</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select class="input_form">
                                <option selected="selected">Selecteaza nationalitatea</option>
                                <option>Romana</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="checkbox" class="check_th"/>
                            <p class="loc_ttt check_th">Sunt de acord cu termenii si conditiile MadreamsRent</p><br>
                            <input type="checkbox" class="check_th"/>
                            <p class="loc_ttt check_th">Doresc sa fiu abonat la newsletterul MadreamsRent</p><br><br>
                            <a href="final_rezervare.html"><p class="book_btn">REZERVA <i class="fas fa-angle-right"></i></p></a>
                        </div>
                    </div>
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
    @endsection