@extends('admin.layouts.master')
@section('content')

    <section>
        <div class="jumbotron reservations_parallax">
            <h1 class="reservations_title">Reservations</h1>
        </div>

        @include('admin.parts.messages.success')
        @include('admin.parts.messages.error')
        @include('admin.parts.messages.custom_error')
        <div class="card">
            <div class="card-header">
                <!-- Button trigger modal -->
                    <div class="float-right ">
                <button type="button" class="btn btn-primary mt-1 btn-lg mr-2" data-toggle="modal" data-target="#addReservation">
                    add Reservation &nbsp; <i class="fas fa-check-double"></i>
                </button>


                    </div>
                <h4 class="apartments_table_title "><u>Reservations Table</u>&nbsp;&nbsp;<i class="fas fa-person-booth"></i></h4>
            </div>
        </div>

            <div class="reservations_container">
        <table class="data_table table table-bordered  table-responsive table-hover display">
            <thead>
            <tr class="bg-dark custom_reservations_table_head  text-center"  >
                <th>#</th>
                <th>Main Client who <br> made the reservation</th>
                <th  class="w-25">Email</th>
                <th>Phone</th>
                <th>Apartment</th>
                <th>Document Picture</th>
                <th class="w-25">Check In</th>
                <th class="w-25">Check Out</th>
                <th>Status</th>
                <th>View Client & Resevation <br> Information</th>
                <th>Clone Reservation</th>
                <th>Edit Reservation</th>
                <th>Cost</th>
                <th>Delete Reservation</th>
            </tr>
            </thead>
            <tbody class="text-center custom_reservation_table_body">
            @php
            $i=1;
            @endphp
            @foreach($reservations as $reservation)
                <tr>
                    <td>{{$i}}</td>
                    <td>
                      {{$reservation->name}}
                    </td>
                    <td>{{$reservation->email}}</td>
                    <td>{{$reservation->phone}}</td>

                    @php
                    $apartment=\App\Apartment::where('id', $reservation->apartment_id)->first();
                    if($apartment){
                      $apartment_photo=\App\Picture::where('apartments_id', $apartment->id)->first();
                    }
                    @endphp
                    <td>
                        @if(!empty($apartment->location))
                        {{$apartment->location}}
                        @endif
                        <hr>
                        @if($apartment_photo)
                            <img src="{{asset("storage/apartments_photos/$apartment_photo->filename")}}" class="" style="width:120px !important; height: auto;">
                        @else
                            <p style="color: darkred">The apartment has no Image available</p>
                        @endif
                    </td>
                        @php

                        $client=\App\Person::where('id',$reservation->persons_id)->first();
                            @endphp
                    <td>
                        @if($client->document_picture)
                            <img src="{{asset("storage/document_photos/$client->document_picture")}}" class="" style="width:110px !important; height: auto;">
                        @else
                            <p><strong>The Client  has no <br>  Image available</strong></p>
                        @endif
                    </td>
                    <td> <strong>{{\Carbon\Carbon::parse($reservation->check_in)->format('Y-M-d')
                   }}</strong></td>
                    <td> <strong>{{\Carbon\Carbon::parse($reservation->check_out)->format('Y-M-d')}}</strong></td>
                    <td><a href="/admin/reservations/status/{{$reservation->id}}" class="btn {{$reservation->status===1 ? 'btn-danger' :'btn-success'}}">{{$reservation->status===1 ? 'Deny' :'Accept'}}</a></td>
                    <td><!-- Button trigger modal for all charactristics -->
                        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#viewReservationDetails-{{$reservation->id}}">
                            <i class="fas fa-eye"></i>
                        </button></td>
                    <td><!-- Button trigger to clone reservation -->
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#cloneReservation-{{$reservation->id}}">
                            <i class="far fa-clone"></i>
                        </button></td>
                    <td><!-- Button trigger modal for edit apartment -->
                        <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#editReservation-{{$reservation->id}}">
                            <i class="fas fa-edit"></i>
                        </button>

                    </td>
                    <td>
                        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#reservationCost{{$reservation->id}}">
                            <i class="fas fa-dollar-sign"></i>
                        </button>
                       </td>
                    <td><a href="/admin/reservations/delete/{{$reservation->id}}" class="btn btn-danger btn-lg" onclick=" return confirm('Are you sure you want to delete this Reservation?')"><i class="fas fa-eraser"></i></a></td>
                </tr>

                @php
                $i++;
                @endphp
            @endforeach
            </tbody>
        </table>
        </div>

        @include('admin.parts.modals.add.reservation')
    </section>

    @foreach($reservations as $reservation)
        @include('admin.parts.modals.view.reservation_cost')
    @endforeach

    @foreach($reservations as $reservation)
        @include('admin.parts.modals.view.reservation')
    @endforeach
    @foreach($reservations as $reservation)
        @include('admin.parts.modals.edit.reservation')
    @endforeach
    @foreach($reservations as $reservation)
        @include('admin.parts.modals.clone.reservation')
        @include('admin.parts.modals.clone.addClient')
    @endforeach
    @php
        $booking_fees=\App\BookingFee::all();
    @endphp
    @foreach($booking_fees as $booking_fee)
        @include('admin.parts.modals.edit.edit_fee')
    @endforeach
    @foreach($reservations as $reservation)
        @include('admin.parts.modals.add.reservation_fee')
    @endforeach
@endsection