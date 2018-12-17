
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
                    <label for="main_client_name" class="add_reservatio_info">Name</label>
                    <input type="text" class="form-control" name="main_client_name" value="{{$reservation->name}}">
                   </div>
                    <div class="form-group mt-3">
                        <label for="main_client_email" class="add_reservatio_info">Email</label>
                        <input type="email" class="form-control" name="main_client_email" value="{{$reservation->email}}">
                    </div>
                    </div>
                        <div class=" mt-2 ml-3 col-md-5" >
                            <p class="edit_reservation_info ml-5">Change Apartment &nbsp;<i class="fas fa-home"></i></p>
                            {{--Slick dropdown for selecting Apartment--}}
                            <select class="edit_slick_apartments" name="apartment"></select>
                        </div>
                    </div>
                            <div class="row">
                        <div class="form-group  col-md-5 ml-3">
                        <label for="main_client_phone">Phone</label>
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
                        <label class="add_reservatio_info mt-3">Document Nr:</label>
                        <input type="text"  class="form-control" name="main_document_nr" value="{{$main_client->document_nr}}">
                    </div>
                    <div class="form-group mt-3 col-md-5">
                    <label for="" class="add_reservatio_info">Document Serial Nr:</label>
                    <input type="text"  class="form-control" name="main_document_serial_nr" value="{{$main_client->document_serial_nr}}">
                    </div>
                        <div class="form-group mt-3 col-md-5 ml-3">
                        <label class="add_reservatio_info">Nationality:</label>
                        <input type="text"  class="form-control" name="main_nationality" value="{{$main_client->nationality}}">
                        </div>


                    </div>
                    <div class="row my-4 ml-5">
                    <div class="col-md-5">
                        <p class="edit_reservation_info text-center">Current Profile Image of The Main Client</p>
                        <img src="{{asset("storage/document_photos/$client->document_picture")}}" class="img-thumbnail" style="width:130px !important; height: auto;">
                    </div>
                    <div class="form-group col-md-5">
                        <p class="edit_reservation_info">Choose another Image for his Profile </p>
                        <input type="file" name="main_profile_image">
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
                            <label class="add_reservatio_info">Client name:</label>
                            <input type="text"  class="form-control" name="client_name[]" value="{{$client->name}}">
                        </div>
                        <div class="form-group col-md-6">
                            <p ><strong><u>Document Type(You may choose only one)</u></strong></p>
                            <input type="checkbox"  class="ml-3" name="document_type[]" value="id_card"
                                    {{$client->document_type==='id_card' ? 'checked': ''}}>&nbsp;Id Card
                            <input type="checkbox" class="ml-3"  name="document_type[]" value="passport"
                                    {{$client->document_type==='passport' ? 'checked': ''}}>&nbsp;Passport
                            <input type="checkbox"  class="ml-3" name="document_type[]" value="other"
                                    {{$client->document_type==='other' ? 'checked': ''}}>&nbsp;Other
                        </div>
                        <div class="form-group col-md-5">
                            <label class="add_reservatio_info">Client Document Nr:</label>
                            <input type="text"  class="form-control" name="client_document_nr[]" value="{{$client->document_nr}}">
                        </div>
                        <div class="form-group col-md-5">
                            <label class="add_reservatio_info">Client Document Serial Nr:</label>
                            <input type="text"  class="form-control" name="client_document_serial_nr[]" value="{{$client->document_serial_nr}}">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="nationality" class="add_reservatio_info">Nationality:</label>
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
                    <div style="overflow: auto; height: 550px; overflow-x: hidden;" >
                    @php
                    $booking_fees=\App\BookingFee::where('reservation_id', $reservation->id)->get();
                    @endphp
                <div class=" mt-2 ml-1 col-md-11">

                            <ul>
                        @foreach($booking_fees as $booking_fee)
                            <div class="form-check" >


                                    <li><strong>{{$booking_fee->name}}</strong>&nbsp;
                                        <div style="float: right">
                                        <a href="/admin/reservations/fee/delete/{{$booking_fee->id}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this fee?')">Delete fee</a>
                                        <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-warning ml-3 btn-sm" data-toggle="modal" data-target="#editFee{{$booking_fee->id}}">
                                               Edit Fee
                                            </button>

                                        </div>
                                        <br>
                                        <br>
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
                <div class="form-group ">
                    <label for=""><u>Check In <strong>(If you do not enter it , it will be the same. Mandatory with Check Out)</strong></u></label>
                    <input type="text" class="form-control"  value="{{\Carbon\Carbon::parse($reservation->check_in)->format('Y-m-d h:m')}}" readonly>
                    <input type="date" name="check_in"  value="{{\Carbon\Carbon::parse($reservation->check_in)->format('Y-m-d h:m')}}" class="form-control" autocomplete="off" >
                </div>
                <div class="form-group mt-4">
                    <label for=""><u>Check Out <strong>(If you do not enter it , it will be the same. Mandatory with Check in)</strong></u></label>
                    <input type="text" class="form-control"  value="{{\Carbon\Carbon::parse($reservation->check_out)->format('Y-m-d h:m')}}" readonly>
                    <input type="date" name="check_out" value="{{$reservation->check_in}}" class="form-control" autocomplete="off" >
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
</div>