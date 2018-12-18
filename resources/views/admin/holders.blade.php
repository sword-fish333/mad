@extends('admin.layouts.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <style>

            /* Always set the map height explicitly to define the size of the div
             * element that contains the map. */
        #map {
            margin-left: 100px;
            margin-top: 20px;
            height: 300px;
            width: 500px;
        }
        .edit_map{
            margin-left: 100px;
            margin-top: 20px;
            height: 300px;
            width: 500px;
        }
    </style>
    <section>
        <div class="jumbotron holders_parallax">
            <div class="dashboard_titles">
            <h1 class="apartments_title">Apartments Holders</h1>
            </div>
        </div>
            @include('admin.parts.messages.success')
            @include('admin.parts.messages.error')
        @include('admin.parts.messages.custom_error')
        <div class="card">
            <div class="card-header">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addHolder">
                    add Holder &nbsp;<i class="fas fa-user-plus"></i>
                </button>
                <h4 class="apartments_table_title"><u>Holders Table</u>&nbsp;&nbsp;</h4>
            </div>
        </div>
                <table class=" data_table table table-hover  table-bordered" >
                    <thead>
                    <tr class="bg-dark custom_apartments_table_head  text-center"  >
                        <th>#</th>
                        <th>Name </th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Apartments for <br>
                        which he is the owner</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @php
                    $increment=1
                    @endphp
                @foreach($holders as $holder)
                    <tr>
                        <td>{{$increment}}</td>
                        <td>{{$holder->name}}</td>
                        <td>{{$holder->address}}</td>
                        <td>{{$holder->email}}</td>
                        <td>{{$holder->phone}}</td>
                    @php
                    $apartments=\App\Apartment::where('holder_id', $holder->id)->get();
                    @endphp
                        <td>
                       <ul>
                           @foreach($apartments as $apartment)
                            @php
                                $apartment_photo=\App\Picture::where('apartments_id', $apartment->id)->first();
                            @endphp


                           <li>{{$apartment->location}}
                               @if($apartment_photo)
                                   <img src="{{asset("storage/apartments_photos/$apartment_photo->filename")}}" class="" style="width:120px !important; height: auto;">
                               @else
                                   <p>There is no Image available</p>
                               @endif
                           </li>
                               <hr>
                               @endforeach
                       </ul>
                    </td>



                        <td><!-- Button trigger modal for edit apartment -->
                            <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#editHolder-{{$holder->id}}">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                        <td><a href="/admin/holders/delete/{{$holder->id}}" class="btn btn-danger btn-lg" onclick=" return confirm('Are you sure you want to delete this Apartment?')"><i class="fas fa-eraser"></i></a></td>
                    </tr>

                    @php
                    $increment++;
                    @endphp
                    @endforeach
                    </tbody>
                </table>


    </section>

    {{--@foreach($holders as $holder)--}}
     {{--@include('admin.parts.modals.edit.holder')--}}
        {{--@endforeach--}}
    @include('admin.parts.modals.add.holder')


@endsection