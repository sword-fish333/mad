@extends('admin.layouts.master')
@section('content')
    <style>

            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
        #map {
            margin-left: 100px;
            margin-top: 20px;
            height: 500px;
            width: 500px;
        }
    </style>
    <section>
        <div class="jumbotron apartments_parallax">
            <h1 class="apartments_title">Apartments</h1>
        </div>
            @include('admin.parts.messages.success')
            @include('admin.parts.messages.error')
        <div class="card">
            <div class="card-header">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addApartment">
                    add Apartment &nbsp; <i class="far fa-building"></i>
                </button>
                <h4 class="apartments_table_title"><u>Apartments Table</u>&nbsp;&nbsp;<i class="fas fa-person-booth"></i></h4>
            </div>
            <div class="card-body">

            </div>
        </div>

    </section>

    @include('admin.parts.modals.add.apartment')
@endsection