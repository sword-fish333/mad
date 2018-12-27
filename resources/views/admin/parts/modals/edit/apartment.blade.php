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
                    <li class=" nav-item"><a class="nav-link" href="#apartment_prices_edit{{$apartment->id}}" data-toggle="tab" > Apartment Prices</a></li>
                    <li class="nav-item"><a class="nav-link"   href="#apartment_fee_edit{{$apartment->id}}" data-toggle="tab">Apartment Fee</a></li>
                    <li class="nav-item"><a class="nav-link"  id="apartment_holder_button{{$apartment->id}}"  href="#apartment_holder_edit{{$apartment->id}}" data-toggle="tab">Apartment Holder</a></li>

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
                            <div class="row">
                    <div class="form-group ml-5 col-md-5">
                        <label for="lat" class="ml-5 new_apartment_label"><u>Latitude</u></label>
                        <input type="text"  name="lat_2"  id="lat2_{{$apartment->id}}" value="{{$apartment->lat}}" class="form-control" readonly >
                    </div>
                    <div class="form-group ml-4 col-md-5">
                        <label for="lng" class="ml-5 new_apartment_label"><u>Longitude</u></label>
                        <input type="text"   name="lng_2" id="lng2_{{$apartment->id}}" value="{{$apartment->lng}}"  class=" form-control" readonly>
                    </div>
                    <div class="form-group ml-5 col-md-5">
                        <label for="edit_address" class=" new_apartment_label"><u> Address</u> <i class="fas fa-map-pin"></i></label>
                        <input type="text"  name="address" value="{{$apartment->location}}" class="edit_address form-control" placeholder="..." >
                    </div>
                    <div class="form-group ml-4 col-md-5 mt-3" >
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

                    <label for="surface" class="ml-5 col-md-8 new_apartment_label"><u>Surface of the apartment</u></label>

                    <div class="input-group ml-5 col-md-3 ">
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
                    <div class="form-group col-md-5 ml-5">
                        <label for="description" class="  new_apartment_label"><u>Description of the Apartment</u></label>
                        <textarea name="description" id="" cols="30" rows="10" class="form-control" required>{{$apartment->description}}</textarea>
                    </div>
                    <div class="form-group col-md-4 mt-4 ml-5">
                        <label for="price" class=" price_label"><u>Price of the apartment</u></label>
                        <input type="number" min="0" name="price" step="0.01" class="form-control" required value="{{$apartment->price}}">
                    </div>
                            </div>
                            <div class="row mb-4 ml-5">
                            <div class="col-md-5">
                        <label for="increment_price" class="mt-5 price_label"><u>With how much do you want to increment the price in time?</u></label>
                        <input type="number" min="0" name="increment_price" value="{{$apartment->increment_price}}" step="0.01" class="form-control" required>
                            </div>
                                <div class="col-md-5" style="margin-top: 110px;">
                            <input type="radio" name="price_type" {{$apartment->kind_increment_price==="%" ? 'checked' :''}} value="%" class="lead">%
                            <input type="radio" name="price_type" value="u.m." {{$apartment->kind_increment_price==="u.m." ? 'checked' :''}}  class="lead ml-4">u.m.
                                </div>
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
                    <div class="form-group col-md-5 ml-5">
                        <label for="photos_apartment " class="new_apartment_label"><u>Photos for the apartment</u></label>
                        <input type="file" name="apartment_photos[]" class="form-control" multiple >

                    </div>

                        </div>
                        <div class="tab-pane" id="apartment_prices_edit{{$apartment->id}}">
                            <h1 class="new_apartment_label mt-5"><center><u>Apartment Prices for a given period</u></center></h1>
                            <button type="button" class="btn btn-info ml-4 my-3" data-toggle="modal" data-target="#addApartmentCost{{$apartment->id}}">
                                &nbsp;Add Apartment fee <i class="far fa-money-bill-alt"></i>
                            </button>
                            @php
                                $apartment_costs=\App\ApartmentCost::where('apartment_id', $apartment->id)->get();
                                $apcost_id=\App\ApartmentCost::where('apartment_id', $apartment->id)->first();
                             if($apcost_id){
                                $ap_id=\App\Apartment::where('id', $apcost_id->apartment_id)->first();
                            }
                            @endphp
                            <div class="message_price" style="display: none;">
                                <div class=" @if(!empty($ap_id)) message_prices{{$ap_id->id}} @endif alert  alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                            <div class=" mt-2 ml-1 col-md-11" style="overflow-y: scroll; height: 400px;">

                                <ul class="costs{{$apartment->id}} @if(!empty($ap_id)) costs_edit{{$ap_id->id}} @endif">
                                    @foreach($apartment_costs as $apartment_cost)
                                        <div class="form-check" >


                                            <li>

                                                <div style="float: right">
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteApCost{{$apartment->id}}({{$apartment_cost->id}}) ">Delete Price</button>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-warning ml-3 btn-sm" data-toggle="modal" data-target="#editPrice{{$apartment_cost->id}}">
                                                        Edit Price
                                                    </button>
                                                </div>
                                                <strong>Price : {{$apartment_cost->price}}</strong>&nbsp;
                                                <p class="cost_ap_info">Start date: <span style="color: darkred"><strong>{{\Carbon\Carbon::parse($apartment_cost->start_date)->toDateString()}}</strong></span></p>
                                                <p class="cost_ap_info">End date: <span style="color: darkred"><strong>{{\Carbon\Carbon::parse($apartment_cost->end_date)->toDateString()}}</strong></span></p>

                                            </li>

                                            <hr>

                                        </div>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    <div class="tab-pane" id="apartment_fee_edit{{$apartment->id}}">
                        <h4 class="apartment_fee_title mt-4">Apartment Fees</h4>
                        <button type="button" class="btn btn-info ml-4 my-3" data-toggle="modal" data-target="#addApartmentFee{{$apartment->id}}">
                            &nbsp;Add Apartment fee <i class="fas fa-file-invoice-dollar"></i>
                        </button>
                        @php
                            $apartment_fees=\App\ApartmentFee::where('apartment_id', $apartment->id)->get();
                        $apfee_first_id=\App\ApartmentFee::where('apartment_id', $apartment->id)->first();
                        if($apfee_first_id){
                        $apfee_id=\App\Apartment::where('id', $apfee_first_id->apartment_id)->first();
                        }
                        @endphp
                        <div class=" mt-2 ml-1 col-md-11" style="overflow-y: scroll; height: 400px;">
                            <div class="message_fee" style="display: none;">
                                <div class=" @if(!empty($apfee_id)) message_fees{{$apfee_id->id}} @endif alert  alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        <div >


                                <ul class="fees{{$apartment->id}} @if(!empty($apfee_id)) fees_edit{{$apfee_id->id}} @endif">
                                    @foreach($apartment_fees as $apartment_fee)
                                        <div class="form-check" >


                                            <li>

                                                <div style="float: right">
                                                    <button type="button" onclick="deleteApFee{{$apartment->id}}({{$apartment_fee->id}})" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this fee?')">Delete fee</button>
                                                    <!-- Button trigger modal -->
                                                    <button type="button" class="btn btn-warning ml-3 btn-sm" data-toggle="modal" data-target="#editApartmentFee{{$apartment_fee->id}}">
                                                        Edit Fee
                                                    </button>
                                                </div>
                                                <strong>{{$apartment_fee->name}}</strong>&nbsp;
                                                <p>Value: &nbsp;<span style="color: darkred"><strong>{{$apartment_fee->value}} &nbsp;&nbsp; {{$apartment_fee->type_of_value}}</strong></span></p>

                                                {{$apartment_fee->description}}
                                            </li>

                                            <hr>

                                        </div>
                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>
                        <div class="tab-pane" id="apartment_holder_edit{{$apartment->id}}">
                            <h1 class="new_apartment_label mt-5"><center><u>Apartment Holder</u></center></h1>
                            <p class="holder_warning "><u>If a holer is selected you can <strong>not </strong>enter a new one</u></p>

                            <ul class="nav nav-tabs" id="tabContent" >
                                <li class="active nav-item"><a class="nav-link" href="#choose_holder{{$apartment->id}}" data-toggle="tab" > Choose Holders</a></li>
                                <li class="nav-item"><a class="nav-link"   href="#add_holder{{$apartment->id}}" data-toggle="tab">Add new Holder</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="choose_holder{{$apartment->id}}">
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

                                                            <input type="radio"  name="holder" value="{{$holder->id}}" {{$apartment->holder_id===$holder->id ? 'checked' : ''}} class="holders{{$apartment->id}} form-check-input">{{$holder->name}}
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
                                @php

                                $holder=\App\ApartmentHolder::where('id', $apartment->holder_id)->first();
                                @endphp
                                <div class="tab-pane" id="add_holder{{$apartment->id}}">
                                    <div class="row ml-4 mt-5">
                                        <div class="form-group col-md-5 ">
                                            <label for="name" class="holder_label_add">Name:</label>
                                            <input type="text" name="holder_name" id="holder_name{{$apartment->id}}" placeholder="...."  class="form-control" >
                                        </div>
                                        <div class="form-group ml-5 col-md-5">
                                            <label for="address" class="holder_label_add">Address:</label>
                                            <input type="text" name="holder_address" id="holder_address{{$apartment->id}}" placeholder="...."  class="form-control" >
                                        </div>
                                        <div class="form-group  col-md-5">
                                            <label for="email" class="holder_label_add">Email:</label>
                                            <input type="email" name="holder_email" id="holder_email{{$apartment->id}}"  placeholder="...." class="form-control" >
                                        </div>
                                        <div class="form-group ml-5 col-md-5">
                                            <label for="email" class="holder_label_add">Phone:</label>
                                            <input type="text" name="holder_phone" id="holder_phone{{$apartment->id}}"   placeholder="...."  class="form-control" >
                                        </div>

                                        <div class="form-group  col-md-5">
                                            <p>Current Image</p>

                                            <label for="document_photo" class="holder_label_add">Add Document Photo <strong> (Optional)</strong></label>
                                            <label class="custom-file-upload"> <input class="custom_file_input" id="document_photo{{$apartment->id}}" type="file" name="document_photo"/> <i class="fas fa-upload"></i></label>
                                        </div>
                                        <div class="form-group  ml-5 col-md-5">
                                            <label for="document_photo" class="holder_label_add">Cnp <strong>(Optional)</strong></label>
                                            <input type="number" min="0" placeholder="...." name="cnp"  id="cnp{{$apartment->id}}" class="form-control">
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary ">Submit Changes</button>
                </form>
            </div>
        </div>
    </div>
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
            $("#add_data{{$apartment->id}}").append(html);
            inc++;
        });
        $('#remove_row_fee').click(function(){
            inc=inc-1;
            //  console.log( i);
            $('.fields_'+inc).remove();
        });


    </script>
    <script>
        $('#apartment_holder_button{{$apartment->id}}').on('click', function() {
            if ($('.holders{{$apartment->id}}').is(':checked')) {
                $("#holder_name{{$apartment->id}}").prop('disabled', true);
                $("#holder_address{{$apartment->id}}").prop('disabled', true);
                $("#holder_phone{{$apartment->id}}").prop('disabled', true);
                $("#holder_email{{$apartment->id}}").prop('disabled', true);
                $("#cnp{{$apartment->id}}").prop('disabled', true);
                $("#document_photo{{$apartment->id}}").prop('disabled', true);
            } else {
                $("#holder_name{{$apartment->id}}").prop('disabled', false);
                $("#holder_address{{$apartment->id}}").prop('disabled', false);
                $("#holder_phone{{$apartment->id}}").prop('disabled', false);
                $("#holder_email{{$apartment->id}}").prop('disabled', false);
                $("#cnp{{$apartment->id}}").prop('disabled', false);
                $("#document_photo{{$apartment->id}}").prop('disabled', false);
            }
        });

        $('#holder_name{{$apartment->id}}').on('input', function() {
            if ($(this).val().length) {
                $(".holders{{$apartment->id}}").prop('disabled', true);
            }else{
                $('.holders{{$apartment->id}}').prop('disabled', false);
            }
        });
        $('input.holders{{$apartment->id}}').click(function(e){
            if (e.ctrlKey) {
                $(this).prop('checked', false);
            }
        });
        $('input.holders{{$apartment->id}}').on('click', function(){
            if($(this).is(':checked')) {
                $("#holder_name{{$apartment->id}}").prop('disabled', true);
                $("#holder_address{{$apartment->id}}").prop('disabled', true);
                $("#holder_phone{{$apartment->id}}").prop('disabled', true);
                $("#holder_email{{$apartment->id}}").prop('disabled', true);
                $("#cnp{{$apartment->id}}").prop('disabled', true);
                $("#document_photo{{$apartment->id}}").prop('disabled', true);
            }else{
                $("#holder_name{{$apartment->id}}").prop('disabled', false);
                $("#holder_address{{$apartment->id}}").prop('disabled', false);
                $("#holder_phone{{$apartment->id}}").prop('disabled', false);
                $("#holder_email{{$apartment->id}}").prop('disabled', false);
                $("#cnp{{$apartment->id}}").prop('disabled', false);
                $("#document_photo{{$apartment->id}}").prop('disabled', false);
            }
        });
    </script>
    <script>

        function loadDataCost{{$apartment->id}}() {

            $.ajax({
                type: 'GET',
                url: '/admin/apartments/view/costs/{{$apartment->id}}',
                success: function (data) {

                    data=JSON.parse(data);

                    var html=[];
                    $(".costs{{$apartment->id}}").empty();
                    data.forEach(function(d)
                    {


                        html+= '<div style="float: right">';
                        html+='<button type="button"  class="btn btn-danger btn-sm" onclick="deleteApCost{{$apartment->id}}('+d.id+')">Delete Price</button>';
                        html+='<button type="button" class="btn btn-warning ml-3 btn-sm" data-toggle="modal" data-target="#editPrice'+d.id+'">Edit Price </button>';
                        html+='</div>';
                        html+='<li><strong>Price: '+d.price+'</strong><br>';
                        html+='start Date:  <span style="color: darkred"><strong>'+d.start_date+'</strong></span><br>';
                        html+='end Date: <span style="color: darkred"><strong>'+d.end_date+'</strong></span>';

                        html+='</li><hr>';


                    });
                    $(".costs{{$apartment->id}}").append(html);
                }
            });
        }
@php
$apartments_costs=\App\ApartmentCost::all();
@endphp

@foreach($apartments_costs as $apartment_cost)
        function loadDataCostEdit{{$apartment_cost->apartment_id}}() {

            $.ajax({
                type: 'GET',
                url: '/admin/apartments/view/costs/{{$apartment_cost->apartment_id}}',
                success: function (data) {

                    data=JSON.parse(data);
                    console.log({{$apartment_cost->apartment_id}});
                    var html=[];

                    $(".costs_edit{{$apartment_cost->apartment_id}}").empty();

                    data.forEach(function(d)
                    {


                        html+= '<div style="float: right">';
                        html+='<button type="button"  class="btn btn-danger btn-sm" onclick="deleteApCost{{$apartment->id}}('+d.id+')">Delete Price</button>';
                        html+='<button type="button" class="btn btn-warning ml-3 btn-sm" data-toggle="modal" data-target="#editPrice'+d.id+'">Edit Price </button>';
                        html+='</div>';
                        html+='<li><strong>Price: '+d.price+'</strong><br>';
                        html+='start Date:  <span style="color: darkred"><strong>'+d.start_date+'</strong></span><br>';
                        html+='end Date: <span style="color: darkred"><strong>'+d.end_date+'</strong></span>';

                        html+='</li><hr>';


                    });

                    $(".costs_edit{{$apartment_cost->apartment_id}}").append(html);

                }
            });
        }
@endforeach

        function deleteApCost{{$apartment->id}}(id) {
          if(  confirm('Are you sure you want to delete this Price ?')) {
              $.ajax({
                  type: 'GET',
                  url: '/admin/apartments/delete/cost/' + id,
                  success: function (data) {
                      loadDataCost{{$apartment->id}}();
                  }
              });
          }
        }
        </script>
    <script>
        function loadData{{$apartment->id}}() {


            $.ajax({
                    type: 'GET',
                    url: '/admin/apartments/view/fees/{{$apartment->id}}',
                    success: function (data) {
                        $(".fees{{$apartment->id}}").html('');
                        data=JSON.parse(data);

                        var html=[];
                        $(".fees{{$apartment->id}}").empty();
                        data.forEach(function(d)
                        {


                            html+= '<div style="float: right">';
                            html+='<button type="button"  class="btn btn-danger btn-sm" onclick="deleteApFee{{$apartment->id}}('+d.id+')">Delete fee</button>';
                            html+='<button type="button" class="btn btn-warning ml-3 btn-sm" data-toggle="modal" data-target="#editApartmentFee'+d.id+'">Edit Fee</button>';
                            html+='</div>';
                            html+='<li><strong>'+d.name+'</strong><br>';
                            html+='Value:'+' <span style="color: darkred; font-weight: bold;">'+d.value+ d.type_of_value+'</span>';
                            html+='<br>'+d.description;

                            html+='</li><hr>';


                        });
                        $(".fees{{$apartment->id}}").append(html);
                    }
                    });
                }
        @php
            $apartments_fees=\App\ApartmentFee::all();
        @endphp

        @foreach($apartments_fees as $apartments_fee)
        function loadDataFeeEdit{{$apartments_fee->apartment_id}}() {


            $.ajax({
                type: 'GET',
                url: '/admin/apartments/view/fees/{{$apartments_fee->apartment_id}}',
                success: function (data) {
                    $(".fees_edit{{$apartments_fee->apartment_id}}").html('');
                    data=JSON.parse(data);

                    var html=[];

                    data.forEach(function(d)
                    {


                        html+= '<div style="float: right">';
                        html+='<button type="button"  class="btn btn-danger btn-sm" onclick="deleteApFee{{$apartment->id}}('+d.id+')">Delete fee</button>';
                        html+='<button type="button" class="btn btn-warning ml-3 btn-sm" data-toggle="modal" data-target="#editApartmentFee'+d.id+'">Edit Fee</button>';
                        html+='</div>';
                        html+='<li><strong>'+d.name+'</strong><br>';
                        html+='Value: <span style="color:darkred;"><strong>'+d.value+d.type_of_value+'</strong></span>';
                        html+='<br>'+d.description;

                        html+='</li><hr>';


                    });

                    $(".fees_edit{{$apartments_fee->apartment_id}}").append(html);
                }
            });
        }
        @endforeach
                function deleteApFee{{$apartment->id}}(id) {
                    confirm('Are you sure you want to delete this fee?');
                    $.ajax({
                        type: 'GET',
                        url: '/admin/apartments/delete/fee/' + id,
                        success: function (data) {
                            loadData{{$apartment->id}}();
                        }
                    });
                }
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