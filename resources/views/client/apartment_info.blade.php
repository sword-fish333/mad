@extends('client.layouts.master')
@section('content')

    <div class="header_title_blue">
        <div class="inner_titl">
            <p class="text_title">{{$apartment->name}}</p>
        </div>
    </div>
    <div class="content_w_title">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @php
                        $apartment_photos=\App\Picture::where('apartments_id', $apartment->id)->get();
                            $first_ap_photo=\App\Picture::where('apartments_id', $apartment->id)->first();
                    @endphp
                    <div id="apartCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#apartCarousel" data-slide-to="0" class="active"></li>
                            @for($i=1; $i<count($apartment_photos); $i++)
                                <li data-target="#apartCarousel" data-slide-to="{{$i}}"></li>
                            @endfor


                        </ol>
                        <div class="carousel-inner">
                            <div class="item active">
                                <img src="{{asset("storage/apartments_photos/$first_ap_photo->filename")}}" class="img_modal_apart">
                            </div>
                            @foreach($apartment_photos as $key=>$apartment_photo)
                                @if($key > 0)
                                <div class="item">
                                    <img src="{{asset("storage/apartments_photos/$apartment_photo->filename")}}" class="img_modal_apart">
                                </div>
                            @endif
                            @endforeach
                        </div>
                        <a class="left carousel-control" href="#apartCarousel" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <a class="right carousel-control" href="#apartCarousel" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
                    </div>
                    <br><br>
                    <p class="blog_text">
                        {!! wordwrap($apartment->description,2000,'<br><br>')!!}
                    </p>
                    @php
                        $apartments_features=\App\ApartmentFeature::where('apartments_id', $apartment->id)->pluck('features_id');
                        $ap_features=\App\Feature::whereIn('id', $apartments_features)->get();
                    @endphp
                    <p class="titl_mc">Facilities:</p>
                    <div class="pad_left">
                        @foreach($ap_features as $ap_feature)
                        <p class="loc_ttt"><i class="fas  ml-3 {{$ap_feature->icon}}  el_ic"></i>&nbsp; &nbsp; {{$ap_feature->name}} </p>
                            @endforeach
                    </div>
                    <hr class="hr_header">
                    <p class="titl_mc">Apartment Characteristics:</p>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="box_camera">
                                <p class="title_box">Features</p>
                                <p class="loc_ttt"><b>Floor:</b> <span style="color: darkred">{{$apartment->floor}}</span></p>
                                <p class="loc_ttt"><b>Maximum number of guests:</b> <span style="color: darkred">{{$apartment->nr_guests}}</span></p>
                                <p class="loc_ttt"><b>Number of stars:</b> <span style="color: darkred">{{$apartment->stars}} &nbsp;<i class="fas fa-star"></i></span></p>
                                <p class="loc_ttt"><b>Surface:</b><span style="color: darkred">{{$apartment->surface}}</span></p>
                           </div>
                        </div>
                        <div class="col-md-4">
                            <div class="box_camera">
                                <p class="title_box">Features</p>

                                <p class="loc_ttt"><b>Number of Bedrooms:</b> <span style="color: darkred">{{$apartment->bedrooms}}</span></p>
                                <p class="loc_ttt"><b>Number of Bathrooms:</b> <span style="color: darkred">{{$apartment->bathrooms}}</span></p>
                                <p class="loc_ttt"><b>Number of Single Beds:</b> <span style="color: darkred">{{$apartment->nr_single_beds}}</span></p>
                                <p class="loc_ttt"><b>Number of Double Beds:</b> <span style="color: darkred">{{$apartment->nr_double_beds}}</span></p>

                            </div>
                        </div>

                    </div>


                    <a href="/clients/reservation/{{$apartment->id}}"><p class="book_btn">BOOK NOW <i class="fas fa-angle-right"></i></p></a>
                </div>
                <div class="col-md-4" >
                    <a href="/clients/reservation/{{$apartment->id}}"><p class="book_btn no_phone">BOOK NOW <i class="fas fa-angle-right"></i></p></a>
                    <div style="background:#0b0c9a; padding-bottom: 30px;padding-top: 20px; margin-bottom: 0;" class="text-center">
                    <i class="far fa-compass icon_map"></i>
                    </div>
                    <div  id="apartment_on_map" style="height: 500px; width:350px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function initMap() {
            var myLatLng = {lat:{{$apartment->lat}}, lng:{{$apartment->lng}} };

            var map = new google.maps.Map(document.getElementById('apartment_on_map'), {
                zoom: 4,
                center: myLatLng
            });

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                title: 'Apartment Location'
            });

            var infowindow = new google.maps.InfoWindow();
            var service = new google.maps.places.PlacesService(map);

            service.getDetails({
                placeId: 'ChIJN1t_tDeuEmsRUsoyG83frY4'
            }, function(place, status) {
                if (status === google.maps.places.PlacesServiceStatus.OK) {
                    var marker = new google.maps.Marker({
                        map: map,
                        position: place.geometry.location
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' +
                            'Place ID: ' + place.place_id + '<br>' +
                            place.formatted_address + '</div>');
                        infowindow.open(map, this);
                    });
                }
            });
        }

    </script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{env('api_key')}}&libraries=places
                    &callback=initMap">

@endsection