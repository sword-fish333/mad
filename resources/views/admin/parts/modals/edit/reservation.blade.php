
<!-- Modal -->
<div class="modal fade" id="editReservation-{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="editReservation-{{$reservation->id}}" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header edit_reservation_modal_header">
                <h5 class="modal-title edit_reservation_modal_title" ><u> Edit reservation</u> <i class="fas fa-edit"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @php
                $data_reservation=$reservation;
                @endphp

                <ul class="nav nav-tabs" id="tabContent" >
                    <li class="active nav-item"><a class="nav-link" href="#main_client{{$reservation->id}}" data-toggle="tab" >Main Client</a></li>
                    <li class="nav-item"><a class="nav-link"   href="#secondary_clients{{$reservation->id}}" data-toggle="tab">Secondary Clients</a></li>
                    <li class="nav-item"><a  class="nav-link"  href="#secondary_photos{{$reservation->id}}" data-toggle="tab">Photos of secondary clients</a></li>
                    <li class="nav-item"><a class="nav-link"   href="#booking_fees{{$reservation->id}}" data-toggle="tab">Reservation Fees</a></li>
                    <li class="nav-item"><a class="nav-link"   href="#reservation_period{{$reservation->id}}" data-toggle="tab">Check in & Out</a></li>

                </ul>
                <form action="/admin/reservations/edit/{{$reservation->id}}" method="post" id="main_form_{{$data_reservation->id}}"  enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content">
                        <div class="tab-pane active" id="main_client{{$reservation->id}}">
                    <h4 class="mt-3 clients_edit_title">Client for which the reservation was made</h4>
                    <div class="row">
                <div class="ml-3 col-md-5 mt-3">
                   <div class="form-group">
                    <label for="main_client_name" class="add_reservation_info">Name</label>
                    <input type="text" class="form-control" name="main_client_name" value="{{$reservation->name}}">
                   </div>
                    <div class="form-group mt-3">
                        <label for="main_client_email" class="add_reservation_info">Email</label>
                        <input type="email" class="form-control" name="main_client_email" value="{{$reservation->email}}">
                    </div>
                    </div>
                        <div class=" mt-2 ml-3 col-md-5" >
                            <p class="add_reservation_info ml-5">Change Apartment &nbsp;<i class="fas fa-home"></i></p>
                            {{--Slick dropdown for selecting Apartment--}}
                            <select class="edit_slick_apartments" name="apartment" ></select>
                        </div>
                    </div>
                            <div class="row">
                        <div class="form-group  col-md-5 ml-3">
                        <label class="add_reservation_info" for="main_client_phone">Phone</label>
                        <input type="text"  class="form-control" name="main_client_phone" value="{{$reservation->phone}}">
                    </div>
                    @php

                    $main_client=\App\Person::where('id', $reservation->persons_id)->first();
                    @endphp
                    <div class="form-group col-md-5">
                        <p ><strong><u>Document Type</u></strong></p>
                        <input type="radio"  class="ml-3" name="main_document_type" value="id_card"
                                {{$main_client->document_type==='id_card' ? 'checked': ''}}>&nbsp;Id Card
                        <input type="radio" class="ml-3"  name="main_document_type" value="passport"
                                {{$main_client->document_type==='passport' ? 'checked': ''}}>&nbsp;Passport
                        <input type="radio"  class="ml-3" name="main_document_type" value="other"
                                {{$main_client->document_type==='other' ? 'checked': ''}}>&nbsp;Other
                    </div>
                            </div>
                    <div class="row">
                    <div class="form-group ml-3 col-md-5">
                        <label class="add_reservation_info mt-3">Document Nr:</label>
                        <input type="text"  class="form-control" name="main_document_nr" value="{{$main_client->document_nr}}">
                    </div>
                    <div class="form-group mt-3 col-md-5">
                    <label for="" class="add_reservation_info">Document Serial Nr:</label>
                    <input type="text"  class="form-control" name="main_document_serial_nr" value="{{$main_client->document_serial_nr}}">
                    </div>
                        <div class="form-group mt-3 col-md-5 ml-3">
                        <label class="add_reservation_info">Nationality:</label>
                        <input type="text"  class="form-control" name="main_nationality" value="{{$main_client->nationality}}">
                        </div>
                        <div class="form-group mt-3 col-md-5">
                            <label for="" class="add_reservation_info">Address of the main Client:</label>
                            <input type="text"  class="form-control" name="main_address" value="{{$main_client->address}}">
                        </div>

                    </div>
                    <div class="row my-4 ml-5">
                    <div class="col-md-5">
                        <p class="edit_reservation_info text-center">Current Profile Image of The Main Client</p>
                        <img src="{{asset("storage/document_photos/$client->document_picture")}}" class="img-thumbnail" style="width:130px !important; height: auto;">
                    </div>
                        <div class="col-md-5">
                    <div class="form-group ">
                        <p class="add_reservation_info">Choose another Image for his Profile </p>

                        <input type="file" name="main_profile_image"  class="form-control" >
                            </div>
                        </div>
                    </div>
                            <div class="form-group  mt-5">
                                <label for="language_id" class="language_label">Change language for messages you want</label>
                                <br>
                                <input type="radio" name="language_id" {{$reservation->languages_id===1 ? 'checked' : ''}} value="1"><b style="color: darkred" required>&nbsp;Spanish</b>
                                <input type="radio" class="ml-5" name="language_id" value="2" {{$reservation->languages_id===2 ? 'checked' : ''}}><b style="color: darkred" >&nbsp;English</b>
                            </div>
                        </div>
                    </div>
                    @php
                        $clients=\App\Person::where('reservation_id' , $reservation->id)->get();
                    @endphp
                        </div>
                        <div class="tab-pane" id="secondary_clients{{$reservation->id}}">
                <h4 class="clients_edit_title mt-4">Secondary clients that stay in the apartment  </h4>
                            <div style="overflow-y: auto;overflow-x: hidden; height: 550px; ">
                            @php
                    $client_nr=1
                    @endphp
                @foreach($clients as $client)
                        <h4 class="ml-4 mt-2 client_nr"><u>{{$client_nr}}.</u></h4>
                    <div class="row ml-3">
                        <div class="form-group col-md-5">
                            <label class="add_reservation_info">Client name:</label>
                            <input type="text"  class="form-control" name="client_name[]" value="{{$client->name}}">
                        </div>
                        <div class="form-group col-md-6">
                            <p  class="add_reservation_info">Document Type(You may choose only one)</p>
                            <input type="checkbox"  class="ml-3" name="document_type[]" value="id_card"
                                    {{$client->document_type==='id_card' ? 'checked': ''}}>&nbsp;Id Card
                            <input type="checkbox" class="ml-3"  name="document_type[]" value="passport"
                                    {{$client->document_type==='passport' ? 'checked': ''}}>&nbsp;Passport
                            <input type="checkbox"  class="ml-3" name="document_type[]" value="other"
                                    {{$client->document_type==='other' ? 'checked': ''}}>&nbsp;Other
                        </div>
                        <div class="form-group col-md-5">
                            <label class="add_reservation_info">Client Document Nr:</label>
                            <input type="text"  class="form-control" name="client_document_nr[]" value="{{$client->document_nr}}">
                        </div>
                        <div class="form-group col-md-5">
                            <label class="add_reservation_info">Client Document Serial Nr:</label>
                            <input type="text"  class="form-control" name="client_document_serial_nr[]" value="{{$client->document_serial_nr}}">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="nationality" class="add_reservation_info">Nationality:</label>
                            <input type="text"  class="form-control" name="nationality[]" value="{{$client->nationality}}">
                        </div>
                    </div>
                        <hr>

                @php

                    $client_nr++;
                @endphp
                @endforeach
                </form>


            </div>
            </div>
            <div class="tab-pane" id="secondary_photos{{$reservation->id}}" >
                <h4 class="clients_edit_title mt-4">Clients Document Photos</h4>
                <div style="overflow: auto; height: 550px; overflow-x: hidden;" >
                @foreach($clients as $client)
                <div class="row"   class="mb-5">

                    <div class="col-md-5 ml-5">
                        <p class="client_edit_name ml-4">{{$client->name}}</p>
                        <p>Current Profile Image</p>
                        <img src="{{asset("storage/document_photos/$client->document_picture")}}" class="img-thumbnail" style="width:110px !important; height: auto;">
                    </div>

                        <div class="col-md-5">
                            <form id="client_form{{$client->id}}" action="" role="form"  enctype="multipart/form-data">
                                @csrf


                            <p class="edit_reservation_info">Choose another Image for his Profile</p>
                            <input type="file" id="client_image" name="client_image" class="form-control">

                            <div class="form-group mt-4">
                                <input type="button"   value="Submit Image"  id="upload_image{{$client->id}}" class=" btn btn-primary btn-block">
                            </div>
                            </form>
                        </div>
                </div>
                        <hr>
                        @endforeach
                </div>
            </div>
                <div class="tab-pane" id="booking_fees{{$reservation->id}}">
                    <h4 class="clients_edit_title mt-4">Booking Fees</h4>
                    <button type="button" class="btn btn-info ml-4 my-3" data-toggle="modal" data-target="#addFee{{$reservation->id}}">
                        &nbsp;Add booking fee <i class="fas fa-file-invoice-dollar"></i>
                    </button>
                    @php
                        $booking_fees=\App\BookingFee::where('reservation_id', $reservation->id)->get();
                    $fee_first_id=\App\BookingFee::where('reservation_id', $reservation->id)->first();
                    if($fee_first_id){
                    $fee_id=\App\Reservation::where('id', $fee_first_id->apartment_id)->first();
                    }
                    @endphp
                    <div class=" mt-2 ml-1 col-md-11" style="overflow-y: scroll; height: 400px;">
                        <div class="message_fee" style="display: none;">
                            <div class="  message_fees{{$reservation->id}}  alert  alert-dismissible fade show" role="alert">
                                <button type="button" class="close text-white" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <div >


                            <ul class="fees{{$reservation->id}}  fees_edit{{$reservation->id}} ">
                                @foreach($booking_fees as $booking_fee)
                                    <div class="form-check" >


                                        <li>

                                            <div style="float: right">
                                                <button type="button" onclick="deleteBookingFee{{$reservation->id}}({{$booking_fee->id}})" class="btn btn-danger btn-sm" >Delete fee</button>
                                                <!-- Button trigger modal -->

                                            </div>
                                            <strong>{{$booking_fee->name}}</strong>&nbsp;
                                            <p>Value: &nbsp;<span style="color: darkred"><strong>{{$booking_fee->value}} &nbsp;&nbsp; {{$booking_fee->type_of_value}}</strong></span></p>

                                            {{$booking_fee->description}}
                                        </li>

                                        <hr>

                                    </div>
                                @endforeach
                            </ul>

                        </div>
                    </div>
            </div>
        <div class="tab-pane" id="reservation_period{{$reservation->id}}">
            <h4 class="clients_edit_title mt-4">Booking Check In & Check Out</h4>
            <div class="col-md-7  offset-2">
                <p class="warning_info">If you do not enter they will remai the same</p>
                <div class="form-group ">
                    <label for=""><u>Check In</u></label>
                    <input type="text" class="form-control"  value="{{\Carbon\Carbon::parse($reservation->check_in)->format('d-M-Y h:m')}}"  readonly>
                    <input type="datetime-local" name="check_in"  id="checkIn" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group mt-4">
                    <label for=""><u>Check Out</u></label>
                    <input type="text" class="form-control"  value="{{\Carbon\Carbon::parse($reservation->check_out)->format('d-M-Y h:m')}}"  readonly>
                    <input type="datetime-local" name="check_out"  class="form-control" autocomplete="off" id="checkOut">
                </div>
                <div class="form-group mt-4">
                    <label for=""><u>Schedule Check In</u></label>
                    <input type="text" class="form-control"  value="{{\Carbon\Carbon::parse($reservation->schedule_check_in)->format('d-M-Y h:m')}}"  readonly>
                    <input type="datetime-local" name="schedule_check_in"  class="form-control" autocomplete="off" id="checkOut">
                </div>
                <div class="form-group mt-4">
                    <label for="schedule_check_out"><u>Schedule Check Out</u></label>
                    <input type="text" class="form-control"  value="{{\Carbon\Carbon::parse($reservation->schedule_check_out)->format('d-M-Y h:m')}}"  readonly>
                    <input type="datetime-local" name="schedule_check_out"  class="form-control" autocomplete="off" id="checkOut">
                </div>
            </div>

    </div>
        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="submit_btn{{$data_reservation->id}}"  class=" btn btn-primary">Save changes&nbsp;<i class="fas fa-save"></i></button>
            </div>
            </div>
        </div>
    </div>
    <script >
        $("#submit_btn{{$data_reservation->id}}").click(function(){
            $('#main_form_{{$data_reservation->id}}').submit();
        });


@foreach($clients as $client )
        /*Add new catagory Event*/
        $("#upload_image{{$client->id}}").click(function(e){
            e.preventDefault();
            var form=new FormData(document.getElementById('client_form{{$client->id}}'));
            $.ajax({
                url:'/admin/reservations/client/image/{{$client->id}}',
                data:form,
                async:false,
                type:'post',
                processData: false,
                contentType: false,
                success:function(response){
                   alert('success , Image Saved');
                },
            });
        });

        @endforeach
        /*Add new catagory Event*/
    </script>

        <script>
            @php
                $apartments=\App\Apartment::all()
            @endphp
            var ddData=[
                    @foreach($apartments as $apartment)
                        @if($apartment->status != 'blocked')
                    @php
                        $apartment_photo=\App\Picture::where('apartments_id', $apartment->id)->first();
                    @endphp
            {
            text: "{{$apartment->location}}",
            value:{{$apartment->id}},
            selected: false,
            description: "{{str_limit($apartment->description,200,'...')}}",
                @if($apartment_photo)
                imageSrc: "{{asset("storage/apartments_photos/$apartment_photo->filename")}}"
                @endif
            },
                @endif
                @endforeach
        ];

    $('.edit_slick_apartments').ddslick({
        data: ddData,
        width: 300,
        imagePosition: "right",
        selectText: "Select Apartment for client",
        defaultSelectedIndex:{{$reservation->apartment_id}}-1,
        onSelected: function (data) {

        }
    });
</script>
<script>


    function loadData{{$reservation->id}}() {


        $.ajax({
            type: 'GET',
            url: '/admin/reservations/view/fees/{{$reservation->id}}',
            success: function (data) {
                $(".fees{{$reservation->id}}").html('');
                data=JSON.parse(data);

                var html=[];

                data.forEach(function(d)
                {


                    html+= '<div style="float: right">';
                    html+='<button type="button"  class="btn btn-danger btn-sm" onclick="deleteBookingFee{{$reservation->id}}('+d.id+')">Delete fee</button>';
                    html+='</div>';
                    html+='<li><strong>'+d.name+'</strong><br>';
                    html+='Value: <span style="color:darkred;"><strong>'+d.value+' '+d.type_of_value+'</strong></span>';
                    html+='<br>'+d.description;

                    html+='</li><hr>';


                });

                $(".fees{{$reservation->id}}").append(html);
            }
        });
    }
    function deleteBookingFee{{$reservation->id}}(id) {
        if( confirm('Are you sure you want to delete this fee?'))
        {
            $.ajax({
                type: 'GET',
                url: '/admin/reservations/delete/fee/' + id,
                success: function (data) {
                    d=JSON.parse(data);
                    if(d['status']==='error') {

                        $(".message_fees{{$reservation->id}}").addClass('alert-danger');
                        $(".message_fee").show();
                        $('.message_fees{{$reservation->id}}').append(d['info_error']);
                        setTimeout(function(){
                            $('.message_fees{{$reservation->id}}').removeClass('alert-danger');
                            $('.message_fees{{$reservation->id}}').empty();
                        },3000);
                    }else if(d['status']==='success') {
                        $(".message_fee").show();
                        $(".message_fees{{$reservation->id}}").addClass(' alert-success');
                        $('.message_fees{{$reservation->id}}').append(d['info_success']);
                        setTimeout(function(){
                            $('.message_fees{{$reservation->id}}').removeClass('alert-success');
                            $('.message_fees{{$reservation->id}}').empty();
                        },3000);

                    }
                    loadData{{$reservation->id}}();
                }
            });
        }
    }
</script>
</div>