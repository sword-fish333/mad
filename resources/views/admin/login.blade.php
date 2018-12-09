@extends('admin.layouts.master')
@section('content')




    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section class=" col-md-6 offset-3 " style="margin-top: 100px;">
        <div class="login-register   " >
            <div class="login-box card">

                <div class="card-body">

                    <form class="form-horizontal form-material " id="loginform" action="{{route('adminLogin')}}" method="post">
                        @csrf
                        <h3 class="box-title m-b-20 custom_title"><u>Sign In </u> &nbsp;<i class="fas fa-sign-in-alt"></i></h3>
                            @include('admin.parts.messages.success')
                            @include('admin.parts.messages.custom_error')
                            @include('admin.parts.messages.error')
                            <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control login_text"  type="email" name="email" placeholder="Email" value="{{old('email')}}"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control login_text" type="password" name="password" placeholder="Password"> </div>
                        </div>

                        <div class="form-group text-center">
                            <div class="col-xs-12 p-b-20">
                                <button class="btn btn-block btn-lg btn-info btn-rounded" type="submit">Log In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>



@endsection