<!-- Modal -->
<div class="modal fade" id="viewApartamentCharacteristics-{{$apartment->id}}" tabindex="-1" role="dialog"
     aria-labelledby="viewApartamentCharacteristics-{{$apartment->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title modal_title_ap">Apartment Characteristics</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row mr-4">
                            <p class="info_apartment ml-5">Holder:</p>&nbsp;&nbsp;
                            @php
                                $holder=\App\ApartmentHolder::where('id', $apartment->holder_id)->pluck('name');

                            @endphp
                            <p class="apartment_data mt-1">@if(count($holder)>0) {{$holder[0]}} @endif</p>
                        </div>
                        <div class="row mr-4">
                            <p class="info_apartment ml-5">Name of the Apartment:</p>&nbsp;&nbsp;
                            @if($apartment->name)
                                <p class="apartment_data mt-1">{{$apartment->name}}</p>
                            @else
                                <p class="apartment_data mt-1 text-danger">There was no information provided for this
                                    apartment</p>
                            @endif
                        </div>

                        <div class="row mr-4">
                            <p class="info_apartment ml-5">Address:
                                <span class="apartment_data mt-1">{{$apartment->location}}</span></p>&nbsp;&nbsp;
                        </div>
                        <div class="row mr-4">
                            <p class="info_apartment ml-5">Latitude:</p>&nbsp;&nbsp;
                            <p class="apartment_data mt-1">{{$apartment->lat}}</p>
                        </div>
                        <div class="row mr-4">
                            <p class="info_apartment ml-5">Longitude:</p>&nbsp;&nbsp;
                            <p class="apartment_data mt-1">{{$apartment->lng}}</p>
                        </div>
                        <div class="row mr-4">
                            <p class="info_apartment ml-5">Surface:</p>&nbsp;&nbsp;
                            <p class="apartment_data mt-1">{{$apartment->surface}}</p>
                        </div>
                        <div class="row mr-4">
                            <p class="info_apartment ml-5">Stars:</p>&nbsp;&nbsp;
                            <p class="apartment_data mt-1">&nbsp;@for($x=1;$x<=(int)$apartment->stars;$x++) <i class="fas fa-star stars_ap"></i>@endfor</p>
                        </div>
                        <div class="row mr-4">
                            <p class="info_apartment ml-5">Price:</p>&nbsp;&nbsp;
                            <p class="apartment_data mt-1">{{$apartment->price}}</p>
                        </div>
                        <div class="row mr-4">
                            <p class="info_apartment ml-5">Increment Price:</p>&nbsp;&nbsp;
                            <p class="apartment_data mt-1">{{$apartment->increment_price}}
                                &nbsp;<strong>{{$apartment->kind_increment_price}}</strong></p>
                        </div>

                    </div>
                    <div class="col-md-5">
                        <div class="row mr-4">
                            <p class="info_apartment ml-5">Floor:&nbsp;&nbsp;
                                <span class="apartment_data mt-1">{{$apartment->floor}}</span></p>
                        </div>
                        <div class="row mr-4">
                            <p class="info_apartment ml-5">Maximum number <br> of guests:
                                <span class="apartment_data mt-1">{{$apartment->nr_guests}}</span></p>&nbsp;
                        </div>
                        <div class="row mr-4">
                            <p class="info_apartment ml-5">Elevator:</p>&nbsp;&nbsp;
                            @if($apartment->elevator===1)
                                <p class="apartment_data mt-1" style="color: darkred">It Has</p>
                            @else
                                <p class="apartment_data mt-1" style="color: darkred">It does not have</p>

                            @endif
                        </div>
                        <div class="row mr-4">
                            <p class="info_apartment ml-5">Bedrooms:
                                <span class="apartment_data mt-1">{{$apartment->bedrooms}}</span></p>&nbsp;
                        </div>
                        <div class="row mr-4">
                            <p class="info_apartment ml-5">Bathrooms:
                                <span class="apartment_data mt-1">{{$apartment->bathrooms}}</span></p>&nbsp;
                        </div>
                        <div class="row mr-4">
                            <p class="info_apartment ml-5">Number of single Beds:
                                <span class="apartment_data mt-1">{{$apartment->nr_single_beds}}</span></p>&nbsp;
                        </div>
                        <div class="row mr-4">
                            <p class="info_apartment ml-5">Number of double Beds:
                                <span class="apartment_data mt-1">{{$apartment->nr_double_beds}}</span></p>&nbsp;
                        </div>
                        <div class="row mr-4">
                            <p class="info_apartment ml-5" style="display: inline">Description:
                            <p>
                            <p style="display: inline">{!! $apartment->description !!}</p>
                        </div>
                    </div>
                </div>
                <div class="custom_background">
                    <p class="info_apartment pl-3 pt-3">Features:</p>&nbsp;
                    <div class="row px-4" style="overflow-y: auto; height: 200px">
                        @php
                            $apartments_features=\App\ApartmentFeature::where('apartments_id', $apartment->id)->pluck('features_id');
                            $ap_features=\App\Feature::whereIn('id', $apartments_features)->get();
                        @endphp

                        @foreach($ap_features as $apartment_feature)
                            <div class="col-md-3 ">
                                <p class="info_apartment">{{$apartment_feature->name}}</p>
                                <p><i class="fas  ml-3 {{$apartment_feature->icon}} fa-3x view_features"></i></p>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                </div>
                @php
                    $apartment_photo=\App\Picture::where('apartments_id', $apartment->id)->get();
                @endphp
                <div class="custom_background">
                    <p class="info_apartment ml-1 col-md-8">Photos of the apartment:</p>
                    <div class="row pl-5 pb-4 pr-4 pt-4" style="overflow-y:auto; height: 350px;">

                        @foreach($apartment_photo  as $apartment_photo)
                            <div class="col-md-6">
                                <img src="{{asset("storage/apartments_photos/$apartment_photo->filename")}}"
                                     class="img-thumbnail" style="height: 120px; width: auto;">
                                <hr>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Close &nbsp;<i
                            class="far fa-times-circle"></i></button>
            </div>
        </div>
    </div>
</div>