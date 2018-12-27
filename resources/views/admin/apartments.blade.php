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
        <div class="jumbotron apartments_parallax">
            <div class="dashboard_titles">
            <h1 class="apartments_title">Apartments</h1>
            </div>
        </div>
            @include('admin.parts.messages.success')
            @include('admin.parts.messages.error')
        @include('admin.parts.messages.custom_error')
        <div class="card">
            <div class="card-header">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addApartment">
                    Add apartment &nbsp; <i class="far fa-building"></i>
                </button>
                <h4 class="apartments_table_title"><u>Apartments Table</u>&nbsp;&nbsp;<i class="fas fa-person-booth"></i></h4>
            </div>
        </div>
                <table class=" data_table table table-hover  table-bordered" >
                    <thead>
                    <tr class="bg-dark custom_apartments_table_head  text-center"  >
                        <th>#</th>
                        <th>Photo</th>
                        <th>Address</th>
                        <th>Description</th>
                        <th>Surface</th>
                        <th>Features</th>
                        <th>Stars</th>
                        <th>Price</th>
                        <th>Variation of Price</th>
                        <th>Type of variation</th>
                        <th>View all characteristics</th>
                        <th>Edit Apartment</th>
                        <th>Delete Apartment</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @php
                    $increment=1
                    @endphp
                @foreach($apartments as $apartment)
                    <tr>
                        <td>{{$increment}}</td>
                    @php
                    $apartment_photo=\App\Picture::where('apartments_id', $apartment->id)->first();
                    @endphp
                        <td>
                            @if($apartment_photo)
                            <img src="{{asset("storage/apartments_photos/$apartment_photo->filename")}}" class="" style="width:150px !important; height: auto;">
                         @else
                          <p>There is no Image available</p>
                            @endif
                    </td>
                        <td>{{$apartment->location}}</td>
                        <td>{{str_limit($apartment->description,250,'...')}}</td>
                        <td>{{$apartment->surface}}</td>
                        @php
                        $apartments_features=\App\ApartmentFeature::where('apartments_id', $apartment->id)->pluck('features_id');
                        $ap_features=\App\Feature::whereIn('id', $apartments_features)->get();
                        @endphp
                        <td>
                            @php
                            $i=0;
                            @endphp
                            <ul>
                                @foreach($ap_features as $apartment_feature)
                                    @if($i<4)
                                    <li>{{$apartment_feature->name}}
                                    </li>
                                    <hr>
                                    @else
                                        <p>and more.....</p>
                                        @break;
                                    @endif
                                    @php
                                    $i++;
                                    @endphp
                                    @endforeach
                            </ul>
                        </td>
                        <td>{{$apartment->stars}}</td>
                        <td>{{$apartment->price}}</td>
                        <td>{{$apartment->increment_price}}</td>
                        <td>{{$apartment->kind_increment_price}}</td>
                        <td><!-- Button trigger modal for all charactristics -->
                            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#viewApartamentCharacteristics-{{$apartment->id}}">
                                <i class="fas fa-eye"></i>
                            </button></td>
                        <td><!-- Button trigger modal for edit apartment -->
                            <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#editApartment-{{$apartment->id}}">
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                        <td><a href="/admin/apartments/delete/{{$apartment->id}}" class="btn btn-danger btn-lg" onclick=" return confirm('Are you sure you want to delete this Apartment?')"><i class="fas fa-eraser"></i></a></td>
                    </tr>

                    @php
                    $increment++;
                    @endphp
                    @endforeach
                    </tbody>
                </table>


    </section>
    @foreach($apartments as $apartment)
    @include('admin.parts.modals.view.apartment')
    @endforeach
    @foreach($apartments as $apartment)
     @include('admin.parts.modals.edit.apartment')
        @endforeach
    @include('admin.parts.modals.add.apartment')

    @foreach($apartments as $apartment)
        @include('admin.parts.modals.add.apartment_fee')
        @endforeach
    @foreach($apartments as $apartment)
        @include('admin.parts.modals.add.apartment_cost')
    @endforeach

    @php
        $apartment_costs=\App\ApartmentCost::all();
    $apartments=\App\Apartment::all();
    @endphp
    @foreach($apartments as $apartment)
        @foreach($apartment_costs as $apartment_cost)
        @include('admin.parts.modals.edit.edit_apartment_price')
        @endforeach
        @endforeach

    @php
        $apartments_fees=\App\ApartmentFee::all();
    $apartments=\App\Apartment::all();
    @endphp
    @foreach($apartments as $apartment)
        @foreach($apartments_fees as $apartment_fee)
            @include('admin.parts.modals.edit.edit_apartment_fee')
        @endforeach
    @endforeach

    <script>
        function initMap() {
            // The location of Madrid
            var madrid = {lat: 40.41, lng:-3.703};
            // The map, centered at Madrid
            var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 4, center: madrid});
            var marker = new google.maps.Marker({
                position: madrid,
                draggable: true,
                animation: google.maps.Animation.DROP,
                map: map});
                var apartments={!! json_encode(\App\Apartment::all())!!};


            apartments.forEach(function(apartment){

                    var map2 = new google.maps.Map(
                        document.getElementById('edit_map' + apartment.id), {zoom: 4, center: madrid});
                    var marker2 = new google.maps.Marker({
                        position: madrid,
                        draggable: true,
                        animation: google.maps.Animation.DROP,
                        map: map2
                    });


                    geocoder = new google.maps.Geocoder();


                    google.maps.event.addListener(marker2, 'dragend', function () {
                        console.log(apartment);
                        console.log( document.getElementById('lat2_' + apartment.id));
                        console.log(marker.getPosition().lat());
                        console.log(apartment.id);
                        document.getElementById('lat2_' + apartment.id).value = marker2.getPosition().lat();
                        document.getElementById('lng2_' + apartment.id).value = marker2.getPosition().lng();
                          var point = marker.getPosition();
                        map.panTo(point);
                        geocoder.geocode({'latLng': marker2.getPosition()}, function (results, status) {
                            if (status == google.maps.GeocoderStatus.OK) {

                                map2.setCenter(results[0].geometry.location);
                                marker2.setPosition(results[0].geometry.location);
                                $('.edit_address').val(results[0].formatted_address);
                            }
                        });
                    });
                });


            geocoder = new google.maps.Geocoder();

            google.maps.event.addListener(marker, 'dragend', function () {
                document.getElementById("latbox").value =marker.getPosition().lat();
                document.getElementById("lngbox").value =marker.getPosition().lng();
                var point = marker.getPosition();
                map.panTo(point);
                geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {


                    if (status == google.maps.GeocoderStatus.OK) {
                        map.setCenter(results[0].geometry.location);
                        marker.setPosition(results[0].geometry.location);
                        $('.address').val(results[0].formatted_address);

                    }
                });
            });

        }




    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{env('api_key')}}
                    &callback=initMap">
    </script>
@endsection