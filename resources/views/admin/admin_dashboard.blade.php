@extends('admin.layouts.master')
@section('content')
    <section>
        <div class="jumbotron dashboard_parallax">
            <h1 class="dashboard_title">Welcome to admin <span style="color: white">Dashboard</span></h1>
            <h4 class="dashboard_subtitle">Here you can make all the changes that you want <br> <span style="color: white">and set up everything</span></h4>
            @include('admin.parts.messages.success')
            @include('admin.parts.messages.error')
        </div>

    </section>
    @endsection