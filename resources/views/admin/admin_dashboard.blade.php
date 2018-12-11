@extends('admin.layouts.master')
@section('content')
    <section>
        <div class="jumbotron dashboard_parallax">
            <div class="dashboard_titles">
            <h1 class="dashboard_title"> Welcome to admin <span style="color: white">Dashboard</span></h1>
            <h4 class="dashboard_subtitle" >Here you can make all the changes that you want <br>and set up everything
                <br><i class="fas fa-keyboard"></i></h4>
            @include('admin.parts.messages.success')
            @include('admin.parts.messages.error')
            </div>
        </div>

    </section>
    @endsection