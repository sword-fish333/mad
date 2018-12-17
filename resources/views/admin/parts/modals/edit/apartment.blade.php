<!-- Modal -->
<div class="modal fade" id="editApartment-{{$apartment->id}}" tabindex="-1" role="dialog" aria-labelledby="editApartment-{{$apartment->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title modal_title_ap" id="exampleModalLabel">Edit Apartment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="tabContent" >
                    <li class="active nav-item"><a class="nav-link" href="#apartment_characteristics_edit{{$apartment->id}}" data-toggle="tab" > Apartment Characteristics</a></li>
                    <li class="nav-item"><a class="nav-link"   href="#apartment_fee_edit{{$apartment->id}}" data-toggle="tab">Apartment Fee</a></li>

                </ul>

                <form action="/admin/apartments/edit/{{$apartment->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content">
                        <div class="tab-pane active" id="apartment_characteristics_edit{{$apartment->id}}">
                    <p class="attention_edit_apartment mt-5">All fields are optional. You can leave everything as it is  <i class="fas fa-exclamation-circle"></i> </p>
                <div class="form-group">
                    <label for="edit_map" class="ml-5 new_apartment_label"><u>Select address of the new apartment </u> &nbsp;<i class="fas fa-map-marked-alt"></i></label>
                    <div class="edit_map" id="edit_map{{$apartment->id}}"></div>
                </div>
                    <div class="form-group ml-5 col-md-4">
                        <label for="lat" class="ml-5 new_apartment_label"><u>Latitude</u></label>
                        <input type="text"  name="lat_2"  id="lat2_{{$apartment->id}}" value="{{$apartment->lat}}" class="form-control" readonly >
                    </div>
                    <div class="form-group offset-1 col-md-4">
                        <label for="lng" class="ml-5 new_apartment_label"><u>Longitude</u></label>
                        <input type="text"   name="lng_2" id="lng2_{{$apartment->id}}" value="{{$apartment->lng}}"  class=" form-control" readonly>
                    </div>
                    <div class="form-group ml-5 col-md-6">
                        <label for="edit_address" class=" new_apartment_label"><u> Address</u> <i class="fas fa-map-pin"></i></label>
                        <input type="text"  name="address" value="{{$apartment->location}}" class="edit_address form-control" placeholder="..." >
                    </div>
                    <div class="form-group col-md-5 mt-3" >
                        <label for="stars" class="stars_label">Nr of Stars for the Apartment <i class="fas fa-star"></i></label>

                        <span class="star_rating_edit row ml-5" style="margin-left: 100px !important;">
           <!--RADIO 1-->
            <input type='checkbox' class="radio_item" value="1" name="edit_stars" {{$apartment->stars >=1 ? 'checked' :''}} id="el{{$apartment->id}}_1">
                <label class="label_item" for="item_1"> &#9734 </label>

                            <!--RADIO 2-->
            <input type='checkbox' class="radio_item" value="2" name="edit_stars" {{$apartment->stars >=2 ? 'checked' :''}} id="el{{$apartment->id}}_2">
            <label class="label_item" for="radio2"> &#9734 </label>

                            <!--RADIO 3-->
            <input type='checkbox' class="radio_item" value="3" name="edit_stars" {{$apartment->stars >=3 ? 'checked' :''}} id="el{{$apartment->id}}_3">
            <label class="label_item" for="radio3"> &#9734 </label>


                            <!--RADIO 4-->
            <input type='checkbox' class="radio_item" value="4" name="edit_stars" {{$apartment->stars >=4 ? 'checked' :''}} id="el{{$apartment->id}}_4">
            <label class="label_item" for="radio4"> &#9734 </label>

                            <!--RADIO 5-->
            <input type='checkbox' class="radio_item" value="5" name="edit_stars" {{$apartment->stars >=5 ? 'checked' :''}} id="el{{$apartment->id}}_5">
            <label class="label_item" for="radio5"> &#9734 </label>
        </span>
                    </div>
                    <label for="surface" class="ml-5 col-md-8 new_apartment_label"><u>Change Surface</u></label>

                    <div class="input-group ml-5 col-md-6 ">
                        <input type="number" step="0.01" min="0" name="surface" value="{{$apartment->surface}}" class="form-control" aria-describedby="basic-addon2" placeholder="..." required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">m<sup>2</sup></span>
                        </div>
                    </div>

                    <label for="surface" class="ml-5 mt-4 col-md-8 new_apartment_label"><u>Change the features of the Apartment</u></label>
                    <div class=" mt-2 ml-5 col-md-12">
                        <div style="overflow: auto; height: 250px; width:350px; "  class="mb-5">

                            @foreach($features as $feature)
                                @php
                                $old_feature=\App\ApartmentFeature::where('apartments_id', $apartment->id)->where('features_id', $feature->id)->get()->count();
                                @endphp
                                <div class="form-check" >
                                    <label class="form-check-label">

                                        <input type="checkbox" name="new_features[]" {{$old_feature>0 ? 'checked' :''}} value="{{$feature->id}}" class="form-check-input">{{$feature->name}}

                                        <img src='{{asset("storage/features_images/$feature->icon")}}' style="width: 100px; right: 0; height: auto" class="ml-5 img-thumbnail" >
                                        <hr>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group col-md-8 ml-5">
                        <label for="description" class="  new_apartment_label"><u>Description of the Apartment</u></label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control" required>{{$apartment->description}}</textarea>
                    </div>
                    <div class="form-group col-md-6 ml-5">
                        <label for="price" class=" price_label"><u>Price of the apartment</u></label>
                        <input type="number" min="0" name="price" step="0.01" class="form-control" required value="{{$apartment->price}}">
                    </div>
                    <div class="form-group col-md-6 ml-5">
                        <label for="increment_price" class=" price_label"><u>With how much do you want to increment the price in time?</u></label>
                        <input type="number" min="0" name="increment_price" value="{{$apartment->increment_price}}" step="0.01" class="form-control" required>
                    </div>
                    <div class="form-group "style="margin-top: 65px;">
                        <fieldset>
                            <input type="radio" name="price_type" {{$apartment->kind_increment_price==="%" ? 'checked' :''}} value="%" class="lead">%
                            <input type="radio" name="price_type" value="u.m." {{$apartment->kind_increment_price==="u.m." ? 'checked' :''}}  class="lead ml-4">u.m.
                        </fieldset>
                    </div>
                    @php
                        $apartment_photo=\App\Picture::where('apartments_id', $apartment->id)->get();
                    @endphp
                    <div class="col-md-11  edit_apartment_pictures ml-4 ">
                        <p class="new_apartment_label  col-md-5"><u>Current Images:</u></p>&nbsp;&nbsp;
                        <div class="row">
                        @foreach($apartment_photo  as $apartment_photo)
                            <div class="col-md-3 img_edit{{$apartment_photo->id}} ml-4">

                                    <a  href='javascript:void(0)' onclick="removeImage({{$apartment_photo->id}})" class="delete_photo  btn btn-sm btn-danger btn-block mb-2" ><i class="fas fa-trash-alt"></i></a>
                                    <img src="{{asset("storage/apartments_photos/$apartment_photo->filename")}}" class="img-thumbnail " style="height: 80px; width: auto; ">
                                    <hr>
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <div class="form-group  ml-5">
                        <label for="photos_apartment " class="new_apartment_label"><u>Photos for the apartment</u></label>
                        <input type="file" name="apartment_photos[]" class="form-control" multiple >

                    </div>
                        </div>
                    <div class="tab-pane" id="apartment_fee_edit{{$apartment->id}}">
                        <h4 class="apartment_fee_title mt-4">Apartment Fees</h4>
                        <button type="button" class="btn btn-info ml-4 my-3" data-toggle="modal" data-target="#addApartmentFee{{$apartment->id}}">
                            &nbsp;Add booking fee <i class="fas fa-file-invoice-dollar"></i>
                        </button>
                        <div style="overflow: auto; height: 550px; overflow-x: hidden;" >
                            @php
                                $apartment_fees=\App\ApartmentFee::where('apartment_id', $apartment->id)->get();
                            @endphp
                            <div class=" mt-2 ml-1 col-md-11">

                                <ul>
                                    @foreach($apartment_fees as $apartment_fee)
                                        <div class="form-check" >


                                            <li>

                                                <div style="float: right">
                                                    <a href="/admin/reservations/fee/delete/{{$apartment_fee->id}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this fee?')">Delete fee</a>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-warning ml-3 btn-sm" data-toggle="modal" data-target="#editFee{{$apartment_fee->id}}">
                                                        Edit Fee
                                                    </button>
                                                </div>
                                                <strong>{{$apartment_fee->name}}</strong>&nbsp;
                                                <p>Value: <span style="color: darkred">{{$apartment_fee->value}} {{$apartment_fee->type_of_value}}</span></p>

                                                {{$apartment_fee->description}}
                                            </li>

                                            <hr>

                                        </div>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-secondary">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ">Submit Changes</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        function removeImage(id) {
            $.ajax({
                mehod:'get',
                url:'/admin/apartments/photos/delete/'+id,
                success:function (data) {
                 $(this).remove();

                    $('.img_edit'+id).remove();

                }

            })
        }



        $('.star_rating_edit input').click( function(){
            starvalue = $(this).attr('value');

            // iterate through the checkboxes and check those with values lower than or equal to the one you selected. Uncheck any other.
            for(    i=0; i<=5; i++){

                if (i <= starvalue){
                    $("#el{{$apartment->id}}_" + i).prop('checked', true);
                } else {
                    $("#el{{$apartment->id}}_" + i).prop('checked', false);
                }
            }
        });
    </script>
        </div>