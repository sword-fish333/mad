@extends('admin.layouts.master')
@section('content')
    <section>
        <div class="jumbotron dashboard_parallax">
            <div class="dashboard_titles">
            <h1 class="dashboard_title"> Welcome to admin <span style="color: white">Dashboard</span></h1>
            <h4 class="dashboard_subtitle" >Here you can make all the changes that you want <br>and set up everything
                <br><i class="fas fa-keyboard"></i></h4>
                <div class="col-md-8 offset-2 text-center">
            @include('admin.parts.messages.success')
            @include('admin.parts.messages.error')
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h1 class="apartments_table_title">Check-Ins for the next 5 days &nbsp;<i class="fas fa-bookmark"></i></h1>
            </div>
            <div class="card-body">
                <table class=" data_table table table-hover  table-bordered" >
                    <thead>
                    <tr class="bg-dark custom_apartments_table_head  text-center"  >
                    <th>Apartment</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Reservation Info</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations_in as $reservation_in)
                            @php
                                    $apartment=\App\Apartment::where('id', $reservation_in->apartment_id)->first();
                            $apartment_photo=\App\Picture::where('apartments_id', $apartment->id)->first();
                            @endphp
                            <tr>
                            <td>{{$apartment->location}}
                                @if($apartment_photo)
                                    <img src="{{asset("storage/apartments_photos/$apartment_photo->filename")}}" class=" float-right" style="height:60px !important; width: auto;">
                                @else
                                    <p>There is no Image available</p>
                                @endif
                            </td>
                            <td>{{\Carbon\Carbon::parse($reservation_in->check_in)->format('Y-m-d')}}</td>
                            <td>{{\Carbon\Carbon::parse($reservation_in->check_out)->format('Y-m-d')}}</td>
                            <td> <button type="button" class="btn btn-success " data-toggle="modal" data-target="#viewReservationDetails-{{$reservation_in->id}}">
                                    <i class="fas fa-eye"></i>
                                </button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h1 class="apartments_table_title">Check-Outs for the next 5 days &nbsp;<i class="fas fa-sign-out-alt"></i></h1>
            </div>
            <div class="card-body">
                <table class=" data_table table table-hover  table-bordered" >
                    <thead>
                    <tr class="bg-dark custom_apartments_table_head  text-center"  >
                        <th>Apartment</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Reservation Info</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reservations_out as $reservation_out)
                        @php
                            $apartment=\App\Apartment::where('id', $reservation_out->apartment_id)->first();
                         $apartment_photo=\App\Picture::where('apartments_id', $apartment->id)->first();

                        @endphp
                        <tr>
                            <td>{{$apartment->location}}
                                @if($apartment_photo)
                                    <img src="{{asset("storage/apartments_photos/$apartment_photo->filename")}}" class="float-right" style="height:60px !important; width: auto;">
                                @else
                                    <p>There is no Image available</p>
                                @endif
                            </td>
                            <td>{{\Carbon\Carbon::parse($reservation_out->check_in)->format('Y-m-d')}}</td>
                            <td>{{\Carbon\Carbon::parse($reservation_out->check_out)->format('Y-m-d')}}</td>
                            <td> <button type="button" class="btn btn-success " data-toggle="modal" data-target="#viewReservationDetails-{{$reservation_out->id}}">
                                    <i class="fas fa-eye"></i>
                                </button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @php
    $reservations=\App\Reservation::all();
    @endphp
    @foreach($reservations as $reservation)
        @include('admin.parts.modals.view.reservation')
    @endforeach
    @endsection