<div class="modal fade" id="modalApartment{{$apartment->id}}" role="dialog">
    <div class="modal-dialog el_modal_sec">
        <div class="modal-content el_modal_sec">
            <div class="modal-header mdh2">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body mdb2">
                @php
                    $apartment_photos=\App\Picture::where('apartments_id', $apartment->id)->get();
                $first_photo=\App\Picture::where('apartments_id', $apartment->id)->first();
                @endphp
                <div id="modalCarousel{{$apartment->id}}" class="carousel slide modalCarousel" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#modalCarousel{{$apartment->id}}" data-slide-to="0" class="active"></li>
                        @for($x=1; $x<count($apartment_photos); $x++)
                        <li data-target="#modalCarousel{{$apartment->id}}" data-slide-to="{{$x}}"></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="{{asset("storage/apartments_photos/$first_photo->filename")}}" class="img_modal_fr">
                        </div>
                        @foreach($apartment_photos as $ap_photo)
                        <div class="item">
                            <img src="{{asset("storage/apartments_photos/$ap_photo->filename")}}" class="img_modal_fr">
                        </div>
                       @endforeach
                    </div>
                    <a class="left carousel-control" href="#modalCarousel{{$apartment->id}}" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#modalCarousel{{$apartment->id}}" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
                <div class="cont_mod">
                    <p class="title_el_ct">{{$apartment->name}}</p>
                    <p class="ap_description">{!! $apartment->description !!}</p>
                    @php
                        $apartments_features=\App\ApartmentFeature::where('apartments_id', $apartment->id)->pluck('features_id');
                        $ap_features=\App\Feature::whereIn('id', $apartments_features)->get();
                    @endphp
                    <div class="beneft" style="overflow-y: auto; max-height: 250px">
                        @foreach($ap_features as $ap_feature)
                        <p class="loc_ttt"><i class="{{$ap_feature->icon}} el_ic"></i> {{$ap_feature->name}}</p>
                        @endforeach
                    </div>
                    <hr class="hr_header2">
                    <p class="titl_mc">Informatii de contact:</p>
                    <p class="loc_ttt"><i class="far fa-compass el_ic"></i> &nbsp;Make a reservation to find out the location</p>
                    <p class="loc_ttt"><i class="fas fa-phone el_ic"></i>  &nbsp; +40 777 777 777</p>
                    <p class="loc_ttt"><i class="fas fa-at el_ic"></i>&nbsp;  info@madreamsrent.com</p>
                    <div style="text-align: center">
                        <a href="/clients/apartment/{{$apartment->id}}"><p class="big_button">View Offer <i class="fas fa-angle-right"></i></p></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>