@extends('client.layouts.master')
@section('content')

    <div class="header_title_blue">
        <div class="inner_titl">
            <p class="text_title">Contact MadreamRent</p>
        </div>
    </div>

    <div class="content_w_title">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @include('admin.parts.messages.success')
                    @include('admin.parts.messages.error')
                    @include('admin.parts.messages.custom_error')
                    <form action="/clients/contact/send" id="email_form" method="post">
                        @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" class="input_form" name="name" placeholder="Full Name...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" class="input_form" name="email" placeholder="Email...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <textarea class="msg_txt" name="message" placeholder="Your message..."></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="checkbox" class="check_th"/>
                            <p class="loc_ttt check_th">
                                I want to be subscribed to the newsletter Madreams Rent</p><br><br>
                            <a id="send_mail"><p class="book_btn">Send <i class="fas fa-angle-right"></i></p></a>
                        </div>
                        <a href="/clients/index" class="ml-4"><p class="book_btn pr-4"><i class="fas fa-angle-left"></i> &nbsp;HOMEPAGE </p></a>

                    </div>
                    </form>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </div>
    @include('client.layouts.modals.preloader')
    <script>
        $('#send_mail').click(function (e) {
            $('#preloader').show();

            e.preventDefault();
            $('#email_form').submit();
        });

    </script>
@endsection