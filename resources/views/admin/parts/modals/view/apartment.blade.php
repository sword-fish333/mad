
<!-- Modal -->
<div class="modal fade" id="viewApartamentCharacteristics-{{$apartment->id}}" tabindex="-1" role="dialog" aria-labelledby="viewApartamentCharacteristics-{{$apartment->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title modal_title_ap" >Apartment Characteristics</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mr-4">
               <p class="info_apartment ml-5">Address:</p>&nbsp;&nbsp;
                <p class="apartment_data mt-1">{{$apartment->location}}</p>
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
                    <p class="info_apartment ml-5">Description:</p>&nbsp;&nbsp;
                    <p class="apartment_data mt-1">{{$apartment->description}}</p>
                </div>
                <div class="row mr-4">
                    <p class="info_apartment ml-5">Surface:</p>&nbsp;&nbsp;
                    <p class="apartment_data mt-1">{{$apartment->surface}}</p>
                </div>
                <div class="row mr-4">
                    <p class="info_apartment ml-5">Stars:</p>&nbsp;&nbsp;
                    <p class="apartment_data mt-1">{{$apartment->stars}} {!! $apartment->stars %2===0 ? '<i class="fas fa-star"></i>' :'<i class="fas fa-star"></i><i class="fas fa-star-half"></i>'!!}</p>
                </div>
                <div class="row mr-4">
                    <p class="info_apartment ml-5">Price:</p>&nbsp;&nbsp;
                    <p class="apartment_data mt-1">{{$apartment->price}}</p>
                </div>
                <div class="row mr-4">
                    <p class="info_apartment ml-5">Increment Price:</p>&nbsp;&nbsp;
                    <p class="apartment_data mt-1">{{$apartment->increment_price}} &nbsp;<strong>{{$apartment->kind_increment_price}}</strong></p>
                </div>
                <div class="row pr-4 pt-4 pl-5 custom_background pb-4">
                    <p class="info_apartment ml-1 col-md-10">Features:</p>&nbsp;
                    @php
                        $apartments_features=\App\ApartmentFeature::where('apartments_id', $apartment->id)->pluck('features_id');
                        $ap_features=\App\Feature::whereIn('id', $apartments_features)->get();
                    @endphp

                        @foreach($ap_features as $apartment_feature)
                            <div class="col-md-4 " style="height: 200px;">
                        <p class="apartment_data"><u>{{$apartment_feature->name}}</u></p>
                                <img src="{{asset("storage/features_images/$apartment_feature->icon")}}" class="img-thumbnail" style="height: 100px; width: auto">
                                <hr>
                            </div>
                        @endforeach
                </div>
                @php
                    $apartment_photo=\App\Picture::where('apartments_id', $apartment->id)->get();
                @endphp
                <div class="row pl-5 custom_background pb-4 pr-4 pt-4">
                    <p class="info_apartment ml-1 col-md-8">Photos of the apartment:</p>&nbsp;&nbsp;
                    @foreach($apartment_photo  as $apartment_photo)
                        <div class="col-md-6">
                            <img src="{{asset("storage/apartments_photos/$apartment_photo->filename")}}" class="img-thumbnail" style="height: 120px; width: auto;">
                            <hr>
                        </div>
                        @endforeach
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Close &nbsp;<i class="far fa-times-circle"></i></button>
            </div>
        </div>
    </div>
</div>