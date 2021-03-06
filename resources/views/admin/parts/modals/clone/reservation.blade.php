
<!-- Modal -->
<div class="modal fade" id="cloneReservation-{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="cloneReservation-{{$reservation->id}}" aria-hidden="true" style="overflow-y:auto !important;">
    <div class="modal-dialog modal-lg" role="document" >
        <div class="modal-content" >
            <div class="modal-header bg-info">
                <h5 class="modal-title edit_reservation_modal_title" ><u> Clone reservation</u> <i class="fas fa-clone"></i></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                @php
                $data_reservation=$reservation;
                @endphp

                <ul class="nav nav-tabs" id="tabContent" >
                    <li class="active nav-item"><a class="nav-link" href="#clone_main_client{{$reservation->id}}" data-toggle="tab" >Main Client</a></li>
                    <li class="nav-item"><a class="nav-link"   href="#clone_secondary_clients{{$reservation->id}}" data-toggle="tab">Secondary Clients</a></li>
                    <li class="nav-item"><a  class="nav-link"  href="#clone_secondary_photos{{$reservation->id}}" data-toggle="tab">Photos of secondary clients</a></li>
                    <li class="nav-item"><a class="nav-link"   href="#clone_reservation_period{{$reservation->id}}" data-toggle="tab">Check in & Out</a></li>

                </ul>
                <form action="/admin/reservations/clone/{{$reservation->id}}" method="post" id="clone_main_form_{{$data_reservation->id}}"  enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content">
                        <div class="tab-pane active" id="clone_main_client{{$reservation->id}}">
                    <h4 class="mt-3 clients_clone_title">Client for which the <br> reservation was made</h4>
                    <div class="row">
                <div class="ml-3 col-md-5 mt-3">
                   <div class="form-group">
                    <label for="main_client_name" class="add_reservation_info">Name</label>
                    <input type="text" class="form-control" name="main_client_name" readonly value="{{$reservation->name}}">
                   </div>
                    <div class="form-group mt-3">
                        <label for="main_client_email" class="add_reservation_info">Email</label>
                        <input type="email" class="form-control" name="main_client_email" readonly value="{{$reservation->email}}">
                    </div>
                    </div>
                        <div class=" mt-2 ml-3 col-md-5" >
                            <p class="edit_reservation_info ml-5">Current  Apartment &nbsp;<i class="fas fa-home"></i></p>
                            {{--Slick dropdown for selecting Apartment--}}
                           @php
                           $current_apartment=\App\Apartment::where('id', $reservation->apartment_id)->first();
                                               $apartment_photo=\App\Picture::where('apartments_id', $current_apartment->id)->first();

                           @endphp
                            <p class="clone_current_apartment">{{$current_apartment->location}}</p>
                            @if($apartment_photo)
                            <img src="{{asset("storage/apartments_photos/$apartment_photo->filename")}}" class="" style="width:150px !important; height: auto; float: right">
                            @else
                                <p>There is no Image available</p>
                            @endif
                        </div>
                    </div>
                            <div class="row">
                        <div class="form-group  col-md-5 ml-3">
                        <label for="main_client_phone">Phone</label>
                        <input type="text"  class="form-control" name="main_client_phone" readonly value="{{$reservation->phone}}">
                    </div>
                    @php

                    $main_client=\App\Person::where('id', $reservation->persons_id)->first();
                    @endphp
                    <div class="form-group col-md-5">
                        <p ><strong><u>Document Type</u></strong></p>
                        <input type="radio"  class="ml-3 radio_clone{{$reservation->id}}" name="main_document_type" readonly value="id_card"
                                {{$main_client->document_type==='id_card' ? 'checked': ''}}>&nbsp;Id Card
                        <input type="radio" class="ml-3 radio_clone{{$reservation->id}}"  name="main_document_type" readonly value="passport"
                                {{$main_client->document_type==='passport' ? 'checked': ''}}>&nbsp;Passport
                        <input type="radio"  class="ml-3 radio_clone{{$reservation->id}}" name="main_document_type" readonly value="other"
                                {{$main_client->document_type==='other' ? 'checked': ''}}>&nbsp;Other
                    </div>
                            </div>
                    <div class="row">
                    <div class="form-group ml-3 col-md-5">
                        <label class="add_reservation_info mt-3">Document Nr:</label>
                        <input type="text"  class="form-control" name="main_document_nr" readonly value="{{$main_client->document_nr}}">
                    </div>
                    <div class="form-group mt-3 col-md-5">
                    <label for="" class="add_reservation_info">Document Serial Nr:</label>
                    <input type="text"  class="form-control" name="main_document_serial_nr" readonly value="{{$main_client->document_serial_nr}}">
                    </div>
                        <div class="form-group mt-3 col-md-5 ml-3">
                        <label class="add_reservation_info">Nationality:</label>
                        <input type="text"  class="form-control" name="main_nationality" readonly value="{{$main_client->nationality}}">
                        </div>


                    </div>
                    <div class="row my-4 ml-5">
                    <div class="col-md-5">
                        <p class="edit_reservation_info text-center">Current Profile Image of The Main Client</p>
                        <img src="{{asset("storage/document_photos/$client->document_picture")}}" class="img-thumbnail" style="width:130px !important; height: auto;">
                    </div>

                    </div>
                    @php
                        $clients=\App\Person::where('reservation_id' , $reservation->id)->get();
                    @endphp
                        </div>
                        <div class="tab-pane" id="clone_secondary_clients{{$reservation->id}}">
                <h4 class="clients_clone_title mt-4">Secondary clients that stay in the apartment  </h4>
                            <button type="button" class="btn btn-info mb-3 mt-3 ml-4" data-toggle="modal" data-target="#addClientToClone{{$reservation->id}}">
                               Add Client &nbsp;<i class="fas fa-user-plus"></i>
                            </button>
                            <div style="overflow-y: auto;overflow-x: hidden; height: 550px; ">
                            @php
                    $client_nr=1
                    @endphp
                @foreach($clients as $client)
                    <div class="clone_secondary_client{{$client->id}} ">
                        <h4 class="ml-4 mt-2 client_nr"><u>{{$client_nr}}.</u></h4>
                    <div class="row ml-3 ">
                        <input type="hidden"  name="client_id[]" value="{{$client->id}}">
                        <div class="form-group col-md-5">
                            <label class="add_reservation_info">Client name:</label>
                            <input type="text"  class="form-control" name="client_name[]"  value="{{$client->name}}">
                        </div>
                        <div class="form-group col-md-6">
                            <p ><strong><u>Document Type(You may choose only one)</u></strong></p>
                            <input type="checkbox"  class="ml-3 " name="document_type[]"  value="id_card"
                                    {{$client->document_type==='id_card' ? 'checked': ''}}>&nbsp;Id Card
                            <input type="checkbox" class="ml-3 "  name="document_type[]" value="passport"
                                    {{$client->document_type==='passport' ? 'checked': ''}}>&nbsp;Passport
                            <input type="checkbox"  class="ml-3 " name="document_type[]" value="other"
                                    {{$client->document_type==='other' ? 'checked': ''}}>&nbsp;Other
                        </div>
                        <div class="form-group col-md-5">
                            <label class="add_reservation_info">Client Document Nr:</label>
                            <input type="text"  class="form-control" name="client_document_nr[]" value="{{$client->document_nr}}">
                        </div>
                        <div class="form-group col-md-5">
                            <label class="add_reservation_info">Client Document Serial Nr:</label>
                            <input type="text"  class="form-control" name="client_document_serial_nr[]"  value="{{$client->document_serial_nr}}">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="nationality" class="add_reservation_info">Nationality:</label>
                            <input type="text"  class="form-control" name="nationality[]" value="{{$client->nationality}}">
                        </div>
                        <div class="form-group col-md-5 ml-2" style="margin-top: 35px;">
                            <a href='javascript:void(0)' onclick="clone_removeClient({{$client->id}})"  class="btn btn-danger">Delete Client &nbsp;<i class="fas fa-user-minus"></i></a>
                      <p class="mt-3 info_delete_clone">His associated image will be deleted</p>
                        </div>
                    </div>
                        <hr>
                    </div>
                @php

                    $client_nr++;
                @endphp
                @endforeach
                <div class="clients_zone{{$reservation->id}}">

                </div>
                </form>


            </div>
            </div>
            <div class="tab-pane" id="clone_secondary_photos{{$reservation->id}}" >
                <h4 class="clients_clone_title mt-4">Clients Document Photos</h4>
                <div style="overflow: auto; height: 550px; overflow-x: hidden;" >
                @foreach($clients as $client)
                    <div class="clone_secondary_client_photo{{$client->id}}">
                <div class="row"   class="mb-5">


                    <div class="col-md-5 ml-5">
                        <p class="client_edit_name ml-4">{{$client->name}}</p>
                        <p>Current Profile Image</p>
                        <img src="{{asset("storage/document_photos/$client->document_picture")}}" class="img-thumbnail" style="width:110px !important; height: auto;">
                    </div>

                        <div class="col-md-5">
                            <form id="clone_client_form{{$client->id}}" action="" role="form"  enctype="multipart/form-data">
                                @csrf


                            <p class="edit_reservation_info">Choose another Image for his Profile</p>
                            <input type="file" id="client_image" name="client_image" class="form-control">

                            <div class="form-group mt-4">
                                <input type="button"   value="Submit Image"  id="clone_upload_image{{$client->id}}" class=" btn btn-primary btn-block">
                            </div>
                            </form>
                        </div>
                </div>
                        <hr>
                    </div>
                        @endforeach
                </div>
            </div>

        <div class="tab-pane" id="clone_reservation_period{{$reservation->id}}">
            <h4 class="clients_clone_title mt-4">Booking Check In & Check Out</h4>
            <div class="col-md-7  offset-2">
                <div class="form-group ">
                    <label for=""><u>Check In <strong>(If you do not enter it , it will be the same. Mandatory with Check Out)</strong></u></label>
                    <input type="text" class="form-control"  value="{{\Carbon\Carbon::parse($reservation->check_in)->format('m-d-Y')}}"  readonly>
                    <input type="date" name="check_in"   class="form-control" autocomplete="off" >
                </div>
                <div class="form-group mt-4">
                    <label for=""><u>Check Out <strong>(If you do not enter it , it will be the same. Mandatory with Check in)</strong></u></label>
                    <input type="text" class="form-control"  value="{{\Carbon\Carbon::parse($reservation->check_out)->format('m-d-Y')}}"  readonly>
                    <input type="date" name="check_out"  class="form-control" autocomplete="off" >
                </div>
            </div>

    </div>
        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="clone_submit_btn{{$data_reservation->id}}"  class=" btn btn-info">Clone Reservation&nbsp;<i class="fas fa-clone"></i></button>
            </div>
            </div>
        </div>
    </div>
    <script >
        $("#clone_submit_btn{{$data_reservation->id}}").click(function(){
            $('#clone_main_form_{{$data_reservation->id}}').submit();
        });


@foreach($clients as $client )
        /*Add new catagory Event*/
        $("#clone_upload_image{{$client->id}}").click(function(e){
            e.preventDefault();
            var form=new FormData(document.getElementById('clone_client_form{{$client->id}}'));
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
            var client_n={{$client_nr}}
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

    {{--$('.clone_slick_apartments').ddslick({--}}
        {{--data: ddData,--}}
        {{--width: 300,--}}
        {{--imagePosition: "right",--}}
        {{--selectText: "Select Apartment for client",--}}
        {{--defaultSelectedIndex:{{$reservation->apartment_id}}-1,--}}
        {{--onSelected: function (data) {--}}

        {{--}--}}
    {{--});--}}
</script>
<script>
    $('.radio_clone{{$reservation->id}}:not(:checked)').attr('disabled', true);

</script>
@foreach($clients as $client)
<script>
    function clone_removeClient(id) {
        confirm('Are you sure you want to remove this client?')
        {
            $(this).remove();

            $('.clone_secondary_client' + id).remove();
            $('.clone_secondary_client_photo' + id).remove();
        }

    }
</script>
@endforeach
</div>