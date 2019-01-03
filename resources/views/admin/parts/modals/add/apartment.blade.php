

<!-- Modal -->
<div class="modal fade" id="addApartment" tabindex="-1" role="dialog" aria-labelledby="addApartment" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header add_apartment_header">
                <h5 class="modal-title custom_modal_title" id="addApartment">Add Apartment to database </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="tabContent" >
                    <li class="active nav-item"><a class="nav-link" href="#apartment_characteristics" data-toggle="tab" > Apartment Characteristics</a></li>
                    <li class="nav-item"><a class="nav-link"   href="#apartment_price" data-toggle="tab">Apartment Prices</a></li>
                    <li class="nav-item"><a class="nav-link"   href="#apartment_fee" data-toggle="tab">Apartment Fee</a></li>
                    <li class="nav-item"><a class="nav-link"   href="#apartment_holder" data-toggle="tab">Apartment Holder</a></li>

                </ul>
                <form action="/admin/apartments/add" method="post" class="row" enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content">
                        <div class="tab-pane active" id="apartment_characteristics">
                <div class="form-group mt-5">
                    <label for="map" class="ml-5 new_apartment_label"><u>Select address of the new apartment </u> &nbsp;<i class="fas fa-map-marked-alt"></i></label>
                    <div id="map"></div>
                </div>
                    <div class="row">
                    <div class="form-group ml-5 col-md-5">
                        <label for="lat" class="ml-5 new_apartment_label"><u>Latitude</u></label>
                        <input type="text" id="latbox" name="lat"  class="form-control" readonly required>
                    </div>
                    <div class="form-group ml-3 col-md-5">
                        <label for="lng" class="ml-5 new_apartment_label"><u>Longitude</u></label>
                        <input type="text" id="lngbox" name="lng"  class="form-control" readonly required>
                    </div>
                    <div class="form-group ml-5 col-md-5">
                        <label for="address" class=" new_apartment_label"><u> Address</u> <i class="fas fa-map-pin"></i></label>
                        <input type="text"  name="address"  class="address form-control" placeholder="..." required>
                    </div>
                        <div class="form-group ml-3 col-md-5">
                            <label for="address" class=" new_apartment_label"><u> Name of the apartment</u> </label>
                            <input type="text"  name="apartment_name"  class=" form-control" placeholder="..." required>
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

                    <label for="surface" class="ml-5 col-md-5 new_apartment_label"><u>Surface</u></label>

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
                        <div class="form-group col-md-5">
                            <label for="photos_apartment">Photos for the apartment</label>
                            <div class="file-upload">
                                <div class="file-select">
                                    <div class="file-select-button" id="fileName">Choose File</div>
                                    <div class="file-select-name" id="noFile">No file chosen...</div>
                                    <input type="file" name="apartment_photos[]" multiple id="chooseFile">
                                </div>
                            </div>

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


                    </div>
                        </div>
                        <div class="tab-pane" id="apartment_price">
                            <h1 class="new_apartment_label mt-5"><center><u>Apartment Prices for specific periods</u></center></h1>
                            <button type="button" id="add_row_price" class="btn btn-primary mt-4" style="margin-left: 30px;">Add Price&nbsp;<i class="fas fa-plus"></i></button>
                            <button type="button" id="remove_row_price" class="btn btn-danger  mt-4  ml-2" >Remove last field of price&nbsp;&nbsp;<i class="fas fa-minus"></i></button>

                            <table class="table table-bordered table-hover ml-4 mt-4" style="width: 730px;">
                                <thead class="bg-dark text-white text-center">
                                <tr>
                                    <th>Price</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>

                                </tr>
                                </thead>
                                <tbody id="add_price_data">

                                </tbody>
                            </table>

                        </div>
                        <div class="tab-pane" id="apartment_fee">
                            <h1 class="new_apartment_label mt-5"><center><u>Apartment Fee</u></center></h1>
                            <button type="button" id="add_row_fee" class="btn btn-primary mt-4" style="margin-left: 30px;">Add Fee for&nbsp;the apartment&nbsp;<i class="fas fa-plus"></i></button>
                            <button type="button" id="remove_row_fee" class="btn btn-danger  mt-4  ml-2" >Remove last field&nbsp;&nbsp;<i class="fas fa-minus"></i></button>

                            <table class="table table-bordered table-hover ml-4 mt-4" style="width: 730px;">
                                <thead class="bg-dark text-white text-center">
                                <tr>
                                    <th>Name of Fee</th>
                                    <th>Description</th>
                                    <th>Value</th>
                                    <th>Type of Value</th>
                                </tr>
                                </thead>
                                <tbody id="add_data">

                                </tbody>
                            </table>

                    </div>
                        <div class="tab-pane" id="apartment_holder">
                            <h1 class="new_apartment_label mt-5"><center><u>Apartment Holder</u></center></h1>
                            <p class="holder_warning "><u>You can either choose an existing holder or you can add a new one</u></p>
                            <p class="holder_warning "><u>If you choose a holder you can not enter another one</u></p>
                            <ul class="nav nav-tabs" id="tabContent" >
                                <li class="active nav-item"><a class="nav-link" href="#choose_holder" data-toggle="tab" > Choose Holders</a></li>
                                <li class="nav-item"><a class="nav-link"   href="#add_holder" data-toggle="tab">Add new Holder</a></li>
                            </ul>
                            <div class="tab-content">
                            <div class="tab-pane active" id="choose_holder">
                                <p class=" text-danger  mt-5 ml-5">If you want to deselect an option keep <strong>ctrl</strong></p>
                                <div class=" mt-5 ml-5">
                                    <p  class="holder_label_add"><strong>Select a Holder:</strong></p>
                                    <div style="overflow: auto; height: 200px; width:350px; "  class="mb-5">
                                        @php
                                            $holders=\App\ApartmentHolder::all();
                                        @endphp
                                        @if(count($holders)!=0)
                                        @foreach($holders as $holder)
                                            <div class="form-check" >
                                                <label class="form-check-label">

                                                    <input type="radio"  name="holder" value="{{$holder->id}}" class="holders form-check-input">{{$holder->name}}
                                                    <br>
                                                    {{$holder->email}}
                                                    <br>
                                                    <hr>
                                                </label>
                                            </div>
                                        @endforeach
                                            @else
                                            <p><strong>There are no holders in the database</strong></p>
                                            @endif
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="add_holder">
                            <div class="row ml-4 mt-5">
                                <div class="form-group col-md-5 ">
                                    <label for="name" class="holder_label_add">Name:</label>
                                    <input type="text" name="holder_name" id="holder_name" class="form-control" placeholder="..." >
                                </div>
                                <div class="form-group ml-5 col-md-5">
                                    <label for="address" class="holder_label_add">Address:</label>
                                    <input type="text" name="holder_address" id="holder_address" class="form-control" placeholder="..." >
                                </div>
                                <div class="form-group  col-md-5">
                                    <label for="email" class="holder_label_add">Email:</label>
                                    <input type="email" name="holder_email" id="holder_email" class="form-control" placeholder="..." >
                                </div>
                                <div class="form-group ml-5 col-md-5">
                                    <label for="email" class="holder_label_add">Phone:</label>
                                    <input type="text" name="holder_phone" id="holder_phone" class="form-control" placeholder="..." >
                                </div>

                                <div class="form-group  col-md-5">
                                    <label for="document_photo" class="holder_label_add">Add Document Photo <strong> (Optional)</strong></label>
                                    <label class="custom-file-upload"> <input class="custom_file_input" id="document_photo" type="file" name="document_photo"/> <i class="fas fa-upload"></i></label>
                                </div>
                                    <div class="form-group  ml-5 col-md-5">
                                        <label for="document_photo" class="holder_label_add">Cnp <strong>(Optional)</strong></label>
                                        <input type="number" min="0" placeholder="...." name="cnp" id="cnp" class="form-control">
                                    </div>

                        </div>
                            </div>

                            </div>
                        </div>
                    </div>
                    </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes <i class="fas fa-save"></i></button>
                </form>
            </div>
        </div>
    </div>
    <script>
        $('#holder_name').on('input', function() {
            if ($(this).val().length) {
                $(".holders").prop('disabled', true);
            }else{
                $('.holders').prop('disabled', false);
            }
        });
        $('input.holders').click(function(e){
            if (e.ctrlKey) {
                $(this).prop('checked', false);
            }
        });
        $('input.holders').on('click', function(){
            if($(this).is(':checked')) {
                $("#holder_name").prop('disabled', true);
                $("#holder_address").prop('disabled', true);
                $("#holder_phone").prop('disabled', true);
                $("#holder_email").prop('disabled', true);
                $("#cnp").prop('disabled', true);
                $("#document_photo").prop('disabled', true);
            }else{
                $("#holder_name").prop('disabled', false);
                $("#holder_address").prop('disabled', false);
                $("#holder_phone").prop('disabled', false);
                $("#holder_email").prop('disabled', false);
                $("#cnp").prop('disabled', false);
                $("#document_photo").prop('disabled', false);
            }
        });
    </script>
    <script>
                {{--jquery for adding dynamic fields in modal--}}
        var inc_p=1;
        var html;
        $("#add_row_price").click(function() {
            html=[];
            html+='<tr class="custom_table_add_price fields_'+inc_p+'">';
            html+='<td><div class="input-group "><input type="numeric" min="0" step="0.00001" name="price_value[]" class="form-control" >';
            html+='<div class="input-group-append">' +
                '<span class="input-group-text" id="basic-addon2"><i class="fas fa-coins"></i></span>' +
                '</div></div></td>';
            html+='<td><input type="date" class="form-control"  name="start_date[]" > </td>';
            html+='<td><input type="date" class="form-control"  name="end_date[]" > </td>';


            html+='</tr>';
            $("#add_price_data").append(html);
            inc_p++;
        });
        $('#remove_row_price').click(function(){
            inc_p=inc_p-1;
            //  console.log( i);
            $('.fields_'+inc_p).remove();
        });


    </script>
    <script>
                {{--jquery for adding dynamic fields in modal--}}
        var inc=1;
        var html;
        $("#add_row_fee").click(function() {
            html=[];
            html+='<tr class="custom_table_add fields_'+inc+'">';
            html+='<td><input type="text" name="fee_name[]" class="form-control" required></td>';
            html+='<td><textarea class="form-control" name="fee_description[]" required></textarea></td>';
            html+='<td><input type="number" class="form-control" min="0" step="0.01" name="fee_value[]" required> </td>';
            html+='<td><input type="radio" value="%" name="type_of_value[]['+ inc+']" required><strong>%</strong><br>' +
                '<input type="radio" value="u.m." name="type_of_value[]['+ inc+']" required><strong>u.m.</strong></td>';

            html+='</tr>';
            $("#add_data").append(html);
            inc++;
        });
                $('#remove_row_fee').click(function(){
                    inc=inc-1;
                    //  console.log( i);
                    $('.fields_'+inc).remove();
                });


    </script>
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