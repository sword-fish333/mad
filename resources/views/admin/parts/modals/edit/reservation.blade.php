
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
                <form action="/admin/reservations/edit/{{$reservation->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <h4 class="mt-3 clients_edit_title">Client for which the reservation was made</h4>
                <div class="form-group col-md-8">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="main_client_name" value="{{$reservation->name}}">
                </div>
                    <div class="form-group col-md-8">
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="main_client_email" value="{{$reservation->email}}">
                    </div>
                    <div class="form-group col-md-8">
                        <label for="">Phone</label>
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
                    <div class="form-group col-md-8">
                        <label for="">Document Nr:</label>
                        <input type="text"  class="form-control" name="main_document_nr" value="{{$main_client->document_nr}}">
                    </div>
                    <div class="form-group col-md-8">
                    <label for="">Document Serial Nr:</label>
                    <input type="text"  class="form-control" name="main_document_serial_nr" value="{{$main_client->document_serial_nr}}">
                      </div>
                    <div class="form-group col-md-8">
                        <label for="">Nationality:</label>
                        <input type="text"  class="form-control" name="main_nationality" value="{{$main_client->nationality}}">
                    </div>
                    <div class="row my-4 ml-5">
                    <div class="col-md-5">
                        <p class="edit_reservation_info text-center">Current Profile Image of The Main Client</p>
                        <img src="{{asset("storage/document_photos/$client->document_picture")}}" class="img-thumbnail" style="width:130px !important; height: auto;">
                    </div>
                    <div class="form-group col-md-5">
                        <p class="edit_reservation_info">Choose another Image for his Profile </p>
                        <input type="file" name="main_profie_image">
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
                            <label for="">Client name:</label>
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
                            <label for="">Client Document Nr:</label>
                            <input type="text"  class="form-control" name="client_document_nr[]" value="{{$client->document_nr}}">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="">Client Document Serial Nr:</label>
                            <input type="text"  class="form-control" name="client_document_serial_nr[]" value="{{$client->document_serial_nr}}">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="">Nationality:</label>
                            <input type="text"  class="form-control" name="nationality[]" value="{{$client->nationality}}">
                        </div>
                    <div class="col-md-5">
                        <p>Current Profile Image</p>
                        <img src="{{asset("storage/document_photos/$client->document_picture")}}" class="img-thumbnail" style="width:110px !important; height: auto;">
                    </div>
                        <div class="col-md-5">
                            <form action="" id="frm{{$client->id}}" enctype="multipart/form-data">
                                @csrf
                            <p class="edit_reservation_info">Choose another Image for his Profile</p>
                            <input type="file" name="client_image{{$client->id}}" class="client_img{{$client->id}}" class="form-control">

                            <div class="form-group mt-4">
                                <input type="button" id="btn_img_frm" onclick="addImage({{$client->id}})" value="Submit Image" class=" btn btn-primary btn-block">
                            </div>
                            </form>
                        </div>
                    </div>
                        <hr>
                    @php

                    $client_nr++;
                    @endphp
                    @endforeach
                        <div class="row">
                            <div class="col-md-6" style="margin-top: 50px;">
                                <p class="edit_reservation_info ml-5">Change Apartment &nbsp;<i class="fas fa-home"></i></p>

                                @php
                                    $current_apartment=\App\Apartment::where('id', $reservation->apartment_id)->first();
                                    $apartments=\App\Apartment::all()
                                @endphp

                                <div class="form-group">
                                    <select  name="apartment" class="form-control" >
                                        @if(!empty($apartment))
                                        <option value="{{$current_apartment->id}}">{{$current_apartment->location}}</option>
                                        @endif
                                    @foreach($apartments as $apartment)
                                            <option value="{{$apartment->id}}">{{$apartment->location}}

                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5 mt-4">
                                <div class="form-group ">
                                    <label for=""><u>Check In <strong>(You have to enter it again)</strong></u></label>
                                    <input type="text" class="form-control"  value="{{\Carbon\Carbon::parse($reservation->check_in)->format('Y-m-d h:m')}}" readonly>
                                    <input type="datetime-local" name="check_in" value="{{\Carbon\Carbon::parse($reservation->check_in)->format('Y-m-d h:m')}}" class="form-control" autocomplete="off" >
                                </div>
                                <div class="form-group ">
                                    <label for=""><u>Check Out <strong>(You have to enter it again)</strong></u></label>
                                    <input type="text" class="form-control"  value="{{\Carbon\Carbon::parse($reservation->check_out)->format('Y-m-d h:m')}}" readonly>
                                    <input type="datetime-local" name="check_out" value="{{\Carbon\Carbon::parse($reservation->check_out)->format('Y-m-d h:m')}}" class="form-control" autocomplete="off" >
                                </div>
                            </div>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes&nbsp;<i class="fas fa-save"></i></button>
                </form>
            </div>
        </div>
    </div>
    <script>


        function addImage(id) {
                    @php
                        $clients=\App\Person::where('reservation_id' , $reservation->id)->get();
                    @endphp
                @foreach($clients as $client)
            var img=$('.client_img{{$client->id}}').val();
                console.log(img);

            var frm=document.getElementById('frm{{$client->id}}');
            var formData = new FormData(frm);
               formData.append('data',img);
            @endforeach
            $.ajax({
                method:'post',
                data:formData,
                contentType: false,
                processData: false,
                url:'/admin/reservations/client/image/'+id,
                success:function (data) {
                    alert('success');

                }

            })

        }
    </script>
</div>