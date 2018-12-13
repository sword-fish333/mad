
<!-- Modal -->
<div class="modal fade" id="editReservation-{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="editReservation-{{$reservation->id}}" aria-hidden="true">
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
                <form action="/admin/reservations/edit/{{$reservation->id}}" method="post" id="main_form_{{$data_reservation->id}}"  enctype="multipart/form-data">
                    @csrf
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
                        <div class="form-group col-md-8">
                        <label for="main_client_phone">Phone</label>
                        <input type="number" min="0" class="form-control" name="main_client_phone" value="{{$reservation->phone}}">
                    </div>
                    @php

                    $main_client=\App\Person::where('id', $reservation->persons_id)->first();
                    @endphp
                    <div class="form-group col-md-8">
                        <p ><strong><u>Document Type</u></strong></p>
                        <input type="radio"  class="ml-3" name="main_document_type" value="id_card"
                                {{$main_client->document_type==='id_card' ? 'checked': ''}}>&nbsp;Id Card
                        <input type="radio" class="ml-3"  name="main_document_type" value="passport"
                                {{$main_client->document_type==='passport' ? 'checked': ''}}>&nbsp;Passport
                        <input type="radio"  class="ml-3" name="main_document_type" value="other"
                                {{$main_client->document_type==='other' ? 'checked': ''}}>&nbsp;Other
                    </div>
                    <div class="row">
                    <div class="form-group ml-4 col-md-5">
                        <label class="add_reservatio_info mt-3">Document Nr:</label>
                        <input type="text"  class="form-control" name="main_document_nr" value="{{$main_client->document_nr}}">
                    <div class="form-group mt-3">
                    <label for="" class="add_reservatio_info">Document Serial Nr:</label>
                    <input type="text"  class="form-control" name="main_document_serial_nr" value="{{$main_client->document_serial_nr}}">
                    </div>
                        <div class="form-group mt-3">
                        <label class="add_reservatio_info">Nationality:</label>
                        <input type="text"  class="form-control" name="main_nationality" value="{{$main_client->nationality}}">
                        </div>
                        </div>
                        <div class="col-md-6 ml-3 mt-4">
                            <div class="form-group ">
                                <label for=""><u>Check In <strong>(You have to enter it again)</strong></u></label>
                                <input type="text" class="form-control"  value="{{\Carbon\Carbon::parse($reservation->check_in)->format('Y-m-d h:m')}}" readonly>
                                <input type="date" name="check_in"  value="{{\Carbon\Carbon::parse($reservation->check_in)->format('Y-m-d h:m')}}" class="form-control" autocomplete="off" >
                            </div>
                            <div class="form-group mt-4">
                                <label for=""><u>Check Out <strong>(You have to enter it again)</strong></u></label>
                                <input type="text" class="form-control"  value="{{\Carbon\Carbon::parse($reservation->check_out)->format('Y-m-d h:m')}}" readonly>
                                <input type="date" name="check_out" value="{{$reservation->check_in}}" class="form-control" autocomplete="off" >
                            </div>
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
                <h4 class="clients_edit_title">Secondary clients that stay in the apartment  </h4>
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
                <hr>
                <hr>
                <h4 class="clients_document_photos">Clients Document Photos</h4>
                @foreach($clients as $client)
                <div class="row">

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