@extends('client.layouts.master')
@section('content')
    <div class="content_w_title">
        <div class="container">
            <div class="row">
                <div class="col-md-3">

                </div>
                <div class="col-md-6">
                    @include('client.layouts.messages.success')
                    <p class="big_text_thx">
                        <span style="color:#0b0c9a"><b>Thank you for the reservation</b></span><br>
                        You will soon receive a confirmation email for your reservation.<br>
                       To return to the home page click the button on the bottom of the page.
                    </p>
                    <a href="/clients/index"><p class="book_btn">HOMEPAGE <i class="fas fa-angle-right"></i></p></a>
                </div>
                <div class="col-md-3">

                </div>
            </div>
        </div>
    </div>
    @endsection