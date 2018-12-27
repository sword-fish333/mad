
<!-- Modal -->
<div class="modal fade" id="addReservation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-xl" role="document"  >
        <div class="modal-content">
            <div class="modal-header  add_reservation_modal_header">
                <h5 class="modal-title add_reservation_title" >Add Reservation</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="tabContent" >
                    <li class="active nav-item"><a class="nav-link" href="#main_client_add" data-toggle="tab" >Main Client</a></li>
                    <li class="nav-item"><a class="nav-link"   href="#secondary_clients_add" data-toggle="tab">Secondary Clients</a></li>
                    <li class="nav-item"><a  class="nav-link"  href="#check_in_out" data-toggle="tab">Check in and Check out & Submit </a></li>


                </ul>
                <form action="/admin/reservations/add" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="tab-content">
                        <div class="tab-pane active" id="main_client_add">
                            <h1 id="main_person_reservation_title">Main Person for which the reservation is made</h1>
                    <div class="row" style="margin-left: 100px">
                        <div class="col-md-4 mt-3 offset-1">
                    <div class="form-group">
                        <label class="add_reservatio_info">Person for which the reservation will be made</label>
                        <input type="text" name="main_name" class="form-control" placeholder="..." required>

                    </div>
                        </div>
                    {{--Slick dropdown for selecting Apartment--}}
                    <div class=" mt-2 ml-5 col-md-5" >
                        <label class="apartment_reservation "><u>Choose apartment for which you want to make reservation</u></label>
                        <select id="slick_apartments" name="apartment" required></select>
                        </div>

                    </div>
                            <div class="row" style="margin-left: 100px;">
                                <div class="offset-1">
                                <p class="mt-3 ml-4"><strong><u> Document Type</u></strong></p>
                                <input type="radio" name="main_document_type" class="ml-3" value="id_card" placeholder="..." required>ID Card
                                <input type="radio" name="main_document_type" class="ml-3" value="passport" placeholder="..." required>Passport
                                <input type="radio" name="main_document_type" class="ml-3" value="other" placeholder="..." required>Other
                                </div>
                                <div class="form-group col-md-4 " style="margin-left: 150px;">
                        <label for="main_email" class="add_reservatio_info">Email</label>
                        <input type="email" name="main_email" class="form-control" placeholder="..." required>
                    </div>
                    <div class="form-group col-md-4 offset-1">
                        <label for="main_phone" class="add_reservatio_info">Phone</label>
                        <input type="number" name="main_phone" min="0" class="form-control" placeholder="..." required>
                    </div>
                    <div class="form-group col-md-4 ml-4">
                        <label for="main_document_nr" class="add_reservatio_info">Document Nr</label>
                        <input type="text" name="main_document_nr" class="form-control" placeholder="..." required>
                    </div>
                    <div class="form-group col-md-4 offset-1">
                        <label for="main_document_serial_nr" class="add_reservatio_info" >Document Serial Nr</label>
                        <input type="number" name="main_document_serial_nr" min="0" class="form-control" placeholder="..." required>
                    </div>
                    <div class="form-group col-md-4 ml-4">
                        <label for="main_nationality" class="add_reservatio_info">Nationality of The main Client</label>
                        <input type="text" name="main_nationality"  class="form-control" placeholder="..." required>
                    </div>
                    <div class="form-group col-md-4 offset-3">
                        <label for="main_document_picture" class="add_reservatio_info">Document Picture</label>


                                <input type="file" name="main_document_picture" class="form-control" required>
                    </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="secondary_clients_add">
            {{--Add persons which will stay in the room area (with jQuery)--}}
                            <h1 id="main_person_reservation_title">Persons that will stay in the same room</h1>
                            <button type="button" id="add_row" class="btn btn-primary mt-4" style="margin-left: 50px;">Add person for reservation&nbsp;&nbsp;<i class="fas fa-plus-circle"></i></button>
                            <button type="button" id="remove_fields" class="btn btn-danger  mt-4  ml-2" >Remove last fields&nbsp;&nbsp;<i class="fas fa-user-minus"></i></button>

                <div style="overflow-x: hidden; overflow-y: auto;  height: 550px">
                <table  class="col-md-11 ml-5 mt-4 table table-hover table-bordered" >
                    <thead class="bg-dark ml-3 text-white table_head_add_reservation">
                    <tr class="text-center">
                        <th>Client Name</th>
                        <th>Document Type <span class="text-danger lead">(choose only one)</span></th>
                        <th>Document Nr</th>
                        <th>Document Serial  Nr</th>
                        <th>Nationality</th>
                        <th>Document Image &nbsp;<span class="text-danger lead">(Mandatory)</span></th>
                    </tr>
                    </thead>
                    <tbody id="add_data">
                    </tbody>
                </table>
                </div>

                        </div>
                        <div class="tab-pane" id="check_in_out">
                            <h1 id="main_person_reservation_title">Reservation Period</h1>
                    <div class="row  mt-5">

                <div class="col-md-6 offset-3">
                        <div class="form-group ">
                            <label for="check_in" class="add_reservatio_info"><u>Check In</u></label>
                            <input type="date" name="check_in" class="form-control" autocomplete="off" required>
                        </div>
                <div class="form-group ">
                    <label for="check_out" class="add_reservatio_info"><u>Check Out</u></label>
                    <input type="date" name="check_out" class="form-control" autocomplete="off" required>
                </div>
                </div>
                    </div>
                            <div class="form-group col-md-6 offset-3">
                                <button type="submit" class="btn btn-primary btn-block  ">Save Data &nbsp;<i class="fas fa-save"></i></button>
                            </div>
                        </div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close &nbsp;<i class="fas fa-times"></i></button>

                </form>
            </div>
        </div>
    </div>

        <script>


            {{--jquery for adding dynamic fields in modal--}}
            var i=1;
            var html;
            $("#add_row").click(function() {
                html=[];
                html+='<tr class="custom_table_add fields_'+i+'">';
                html+='<td><input type="text" class="form-control mt-3" name="client_name[]" /></td>';
                html+='<td><input type="radio" class="ml-3 " value="id_card"  name="document_type[]['+ i+']" />&nbsp;ID Card<br>';
                html+='<input type="radio" class=" ml-3 " value="passport" name="document_type[]['+ i+']"" />&nbsp;Passport<br>';
                html+='<input type="radio" class="ml-3 " value="other" name="document_type[]['+ i+']"" />&nbsp;Other</td>';
                html+='<td><input type="text" class="form-control mt-3" name="document_nr[]" /></td>';
                html+='<td><input type="text" class="form-control mt-3" name="document_serial_nr[]" /></td>';
                html+='<td><input type="text" class="form-control mt-3" name="nationality[]" /></td>';
                html+='<td><label class="custom-file-upload"> <input class="custom_file_input" type="file" name="image[]"/> <i class="fas fa-upload"></i></label></td>';

                html+='</tr>';
                $("#add_data").append(html);
           i++;
            });


            $('#remove_fields').click(function(){
                i=i-1;
              //  console.log( i);
                $('.fields_'+i).remove();
            });

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

$('#slick_apartments').ddslick({
            data: ddData,
            width: 300,
            imagePosition: "right",
            selectText: "Select Apartment for client",
            onSelected: function (data) {

            }
        });
    </script>


</div>