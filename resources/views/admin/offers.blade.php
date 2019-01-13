@extends('admin.layouts.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <section>
        <div class="jumbotron offers_parallax">
            <div class="dashboard_titles">
                <h1 class="apartments_title">Special Offers</h1>
            </div>
        </div>
        @include('admin.parts.messages.success')
        @include('admin.parts.messages.error')
        @include('admin.parts.messages.custom_error')
        <div class="card">
            <div class="card-header">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-info float-right" data-toggle="modal" data-target="#addOffer">
                    add Special Offer &nbsp;<i class="fas fa-gift"></i>
                </button>
                <h4 class="apartments_table_title"><u>Special Offers to Restaurants</u>&nbsp;&nbsp;</h4>
            </div>
        </div>
        <table class=" data_table table table-hover  table-bordered" >
            <thead>
            <tr class="bg-dark custom_apartments_table_head  text-center"  >
                <th>#</th>
                <th>Name of the Restaurant/Bar</th>
                <th>Description</th>
                <th>Image</th>
                <th>Value</th>

                <th>View & Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody class="text-center">
            @php
                $increment=1
            @endphp
            @foreach($offers as $offer)
                <tr>
                    <td>{{$increment}}</td>
                    <td>{{$offer->name}}</td>
                    <td style="max-width: 100px !important; overflow-x: scroll">{{str_limit($offer->description,50,'...')}}</td>
                    <td>
                        @if($offer->image)
                            <img src="{{asset("storage/offers_images/$offer->image")}}" class="" style="width:120px !important; height: auto;">
                        @else
                            <p>there is no image available</p>
                        @endif
                    </td>
                    <td>{{$offer->discount}}</td>





                    <td><!-- Button trigger modal for edit apartment -->
                        <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#editOffer{{$offer->id}}">
                            <i class="fas fa-edit"></i> <i class="fas fa-eye"></i>
                        </button>
                    </td>
                    <td><a href="/admin/offers/delete/{{$offer->id}}" class="btn btn-danger btn-lg" onclick=" return confirm('Are you sure you want to delete this  Offer?')"><i class="fas fa-eraser"></i></a></td>
                </tr>

                @php
                    $increment++;
                @endphp
            @endforeach
            </tbody>
        </table>


    </section>
    @foreach($offers as $offer)
        @include('admin.parts.modals.edit.offer')
    @endforeach
    @include('admin.parts.modals.add.offer')


@endsection