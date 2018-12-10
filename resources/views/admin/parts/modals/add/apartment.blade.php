

<!-- Modal -->
<div class="modal fade" id="addApartment" tabindex="-1" role="dialog" aria-labelledby="addApartment" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title custom_modal_title" id="addApartment">Add Apartment to database </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/apartments/add" method="post" class="row" enctype="multipart/form-data">
                    @csrf
                <div class="form-group">
                    <label for="map" class="ml-5 new_apartment_label"><u>Select address of the new apartment </u> &nbsp;<i class="fas fa-map-marked-alt"></i></label>
                    <div id="map"></div>
                </div>

                    <div class="form-group ml-5 col-md-4">
                        <label for="lat" class="ml-5 new_apartment_label"><u>Latitude</u></label>
                        <input type="text" id="latbox" name="lat"  class="form-control" readonly required>
                    </div>
                    <div class="form-group offset-1 col-md-4">
                        <label for="lng" class="ml-5 new_apartment_label"><u>Longitude</u></label>
                        <input type="text" id="lngbox" name="lng"  class="form-control" readonly required>
                    </div>
                    <div class="form-group ml-5 col-md-6">
                        <label for="address" class=" new_apartment_label"><u> Address</u> <i class="fas fa-map-pin"></i></label>
                        <input type="text"  name="address"  class="address form-control" placeholder="..." required>
                    </div>

                        <div class="form-group col-md-5 mt-3" >
                            <label for="stars" class="stars_label">Nr of Stars for the Apartment <i class="fas fa-star"></i></label>

            <span class="star-rating row ml-5" style="margin-left: 100px !important;">
           <!--RADIO 1-->
            <input type='checkbox' class="radio_item" value="1" name="stars" id="radio1">
                <label class="label_item" for="radio1"> &#9734 </label>

                               <!--RADIO 2-->
            <input type='checkbox' class="radio_item" value="2" name="stars" id="radio2">
            <label class="label_item" for="radio2"> &#9734 </label>

                               <!--RADIO 3-->
            <input type='checkbox' class="radio_item" value="3" name="stars" id="radio3">
            <label class="label_item" for="radio3"> &#9734 </label>


                               <!--RADIO 4-->
            <input type='checkbox' class="radio_item" value="4" name="stars" id="radio4">
            <label class="label_item" for="radio4"> &#9734 </label>

                               <!--RADIO 5-->
            <input type='checkbox' class="radio_item" value="5" name="stars" id="radio5">
            <label class="label_item" for="radio5"> &#9734 </label>
        </span>
                        </div>

                    <label for="surface" class="ml-5 col-md-8 new_apartment_label"><u>Surface</u></label>

                        <div class="input-group ml-5 col-md-6 ">
                        <input type="number" step="0.01" min="0" name="surface" class="form-control" aria-describedby="basic-addon2" placeholder="..." required>
                        <div class="input-group-append">
                            <span class="input-group-text" id="basic-addon2">m<sup>2</sup></span>
                        </div>
                        </div>
                    <label for="surface" class="ml-5 mt-4 col-md-8 new_apartment_label"><u>Features of the Apartment</u></label>
                    <div class=" mt-2 ml-5 col-md-12">
                        <div style="overflow: auto; height: 250px; width:350px; "  class="mb-5">

                        @foreach($features as $feature)
                            <div class="form-check" >
                                <label class="form-check-label">

                                    <input type="checkbox" name="features[]" value="{{$feature->id}}" class="form-check-input">{{$feature->name}}

                                        <img src='{{asset("storage/features_images/$feature->icon")}}' style="width: 100px; right: 0; height: auto" class="ml-5 img-thumbnail" >
                                    <hr>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    </div>

                    <div class="form-group col-md-8 ml-5">
                        <label for="description" class="  new_apartment_label"><u>Description of the Apartment</u></label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control" required></textarea>
                    </div>
                    <div class="form-group col-md-6 ml-5">
                        <label for="price" class=" price_label"><u>Price of the apartment</u></label>
                        <input type="number" min="0" name="price" step="0.01" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6 ml-5">
                        <label for="increment_price" class=" price_label"><u>With how much do you want to increment the price in time?</u></label>
                        <input type="number" min="0" name="increment_price" step="0.01" class="form-control" required>
                    </div>
                    <div class="form-group "style="margin-top: 65px;">
                       <fieldset>
                        <input type="radio" name="price_type" value="%" class="lead">%
                        <input type="radio" name="price_type" value="u.m." class="lead ml-4">u.m.
                       </fieldset>
                    </div>

                    <div class="form-group">
                        <label for="photos_apartment">Photos for the apartment</label>
                        <input type="file" name="apartment_photos[]" class="form-control" multiple >
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes <i class="fas fa-save"></i></button>
                </form>
            </div>
        </div>
    </div>
    <script>



        $('.star-rating input').click( function(){
            starvalue = $(this).attr('value');

            // iterate through the checkboxes and check those with values lower than or equal to the one you selected. Uncheck any other.
            for(i=0; i<=5; i++){
                if (i <= starvalue){
                    $("#radio" + i).prop('checked', true);
                } else {
                    $("#radio" + i).prop('checked', false);
                }
            }
        });
    </script>


</div>