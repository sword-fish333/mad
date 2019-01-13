<!-- Modal -->
<div class="modal fade" id="addReservation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="z-index: 100;">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header  add_reservation_modal_header">
                <h5 class="modal-title add_reservation_title">Add Reservation</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="tabContent">
                    <li class="active nav-item"><a class="nav-link" href="#main_client_add" data-toggle="tab">Main
                            Client</a></li>
                    <li class="nav-item"><a class="nav-link" href="#secondary_clients_add" data-toggle="tab">Secondary
                            Clients</a></li>
                    <li class="nav-item"><a class="nav-link" href="#check_in_out" data-toggle="tab">Check in and Check
                            out & Submit </a></li>


                </ul>
                <form action="/admin/reservations/add" method="post" id="save_reservation_form"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="tab-content">
                        <div class="tab-pane active" id="main_client_add">

                            <h1 id="main_person_reservation_title">Main Person for which the reservation is made</h1>
                            <div class="row " style="margin-left: 160px;">
                                <p class="warning_info"><i class="fas fa-exclamation-triangle fa-2x"></i>&nbsp;&nbsp;All
                                    fields are required . If you miss one the reservation will not be made</p>
                                <div class="form-group">
                                    <label for="language" class="language_label">Select language for reservation
                                        depending on which the messages will be send: </label>

                                    <input type="radio" name="language_id" class="ml-3" value="1"><b
                                            style="color: darkred" required>&nbsp;Spanish</b>
                                    <input type="radio" class="ml-2" name="language_id" checked="checked" value="2"><b
                                            style="color: darkred">&nbsp;English</b>
                                </div>
                            </div>
                            <div class="row" style="margin-left: 100px">
                                <div class="form-group ml-5 col-md-11">
                                    <p class="holder_reservation"><input type="checkbox" id="holder_reservation"
                                                                         name="holder" value="holder"> &nbsp;Check if
                                        the reservation is made for the holder of the apartment</p>
                                </div>
                                <div class="holder_message ml-5 col-md-11">

                                </div>
                                <div class="col-md-4 mt-3 offset-1">
                                    <div class="form-group">
                                        <label class="add_reservation_info mb-4">Person for which the reservation will
                                            be
                                            made</label>
                                        <input type="text" name="main_name" class="form-control" placeholder="..."
                                               required>

                                    </div>
                                </div>
                                {{--Slick dropdown for selecting Apartment--}}
                                <div class=" mt-2 ml-5 col-md-5">
                                    <label class="add_reservation_info mb-4">Choose apartment for which you want to make
                                        reservation</label>
                                    <select id="slick_apartments" name="apartment" required></select>
                                </div>

                            </div>
                            <div class="row" style="margin-left: 100px;">
                                <div class="offset-1">
                                    <p class="mt-3 ml-4 add_reservation_info"> Document Type</p>
                                    <input type="radio" name="main_document_type" class="ml-3" value="id_card"
                                           placeholder="..." required>ID Card
                                    <input type="radio" name="main_document_type" class="ml-3" value="passport"
                                           placeholder="..." required>Passport
                                    <input type="radio" name="main_document_type" class="ml-3" value="other"
                                           placeholder="..." required>Other
                                </div>
                                <div class="form-group col-md-4 mt-4" style="margin-left: 130px;">
                                    <label for="main_email" class="add_reservation_info">Email</label>
                                    <input type="email" name="main_email" class="form-control" placeholder="..."
                                           required>
                                </div>
                                <div class="form-group col-md-4 offset-1">
                                    <label for="main_phone" class="add_reservation_info">Phone</label>
                                    <input type="number" name="main_phone" min="0" class="form-control"
                                           placeholder="..." required>
                                </div>
                                <div class="form-group col-md-4 ml-4">
                                    <label for="main_document_nr" class="add_reservation_info">Document Nr</label>
                                    <input type="text" name="main_document_nr" class="form-control" placeholder="..."
                                           required>
                                </div>
                                <div class="form-group col-md-4 offset-1">
                                    <label for="main_document_serial_nr" class="add_reservation_info">Document Serial
                                        Nr</label>
                                    <input type="number" name="main_document_serial_nr" min="0" class="form-control"
                                           placeholder="...">
                                </div>
                                <div class="form-group col-md-4 ml-4">
                                    <label for="main_nationality" class="add_reservation_info">Nationality of The main
                                        Client</label>
                                    <input type="text" name="main_nationality" class="form-control" placeholder="..."
                                           required>
                                </div>
                                <div class="form-group col-md-4 offset-1">
                                    <label for="main_nationality" class="add_reservation_info">Address of the Main
                                        Client</label>
                                    <input type="text" name="main_address" class="form-control" placeholder="..."
                                           required>
                                </div>
                                <div class="form-group col-md-4 ml-4">
                                    <label for="main_document_picture" class="add_reservation_info">Document
                                        Picture</label>
                                    <div class="file-upload">
                                        <div class="file-select">
                                            <div class="file-select-button" id="fileName">Choose File</div>
                                            <div class="file-select-name" id="noFile">No file chosen...</div>
                                            <input type="file" name="main_document_picture" id="chooseFile" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="secondary_clients_add">
                            {{--Add persons which will stay in the room area (with jQuery)--}}
                            <h1 id="main_person_reservation_title">Persons that will stay in the same room</h1>
                            <button type="button" id="add_row" class="btn btn-primary mt-4" style="margin-left: 50px;">
                                Add person for reservation&nbsp;&nbsp;<i class="fas fa-plus-circle"></i></button>
                            <button type="button" id="remove_fields" class="btn btn-danger  mt-4  ml-2">Remove last
                                fields&nbsp;&nbsp;<i class="fas fa-user-minus"></i></button>

                            <div style="overflow-x: hidden; overflow-y: auto;  height: 550px">
                                <table class="col-md-11 ml-5 mt-4 table table-hover table-bordered">
                                    <thead class="bg-dark ml-3 text-white table_head_add_reservation">
                                    <tr class="text-center">
                                        <th>Client Name</th>
                                        <th>Document Type <span class="text-danger lead">(choose only one)</span></th>
                                        <th>Document Nr</th>
                                        <th>Document Serial Nr</th>
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
                            <div class="col-md-10 offset-2 ">
                                <p class="warning_info"><i class="fas fa-exclamation-triangle fa-2x"></i>&nbsp;&nbsp;An
                                    email will be send to the client with the reservation details</p>
                            </div>
                            <div class="row  mt-5">

                                <div class="col-md-6 offset-3">
                                    <div class="form-group ">
                                        <label for="check_in" class="add_reservation_info"><u>Check In</u></label>
                                        <input type="text" name="check_in" class="form-control check_date"
                                               autocomplete="off" required>
                                    </div>
                                    <div class="form-group ">
                                        <label for="check_out" class="add_reservation_info"><u>Check Out</u></label>
                                        <input type="text" name="check_out" class="form-control check_date"
                                               autocomplete="off" required>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group col-md-6 offset-3">
                                <button type="submit" class="btn btn-primary btn-block " id="save_reservation_button">
                                    Save Data And Send mail to client with reservation details&nbsp; <i
                                            class="fas fa-envelope"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer ">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close &nbsp;<i
                                    class="fas fa-times"></i></button>

                </form>
            </div>
        </div>
    </div>

    <script>
        $( function() {
            $( ".check_date" ).datepicker({

                format:'DD/MM/YYYY',
                minDate:0

            });
        } );
        function testInputs() {
            var inputs = $('form#save_reservation_form :input').filter('[required]:visible');
            for (var i = 0; i < inputs.length; i++) {
                if (inputs.eq(i).val() === "") {
                    return false;
                }
            }


            return true;
        }

        $("#save_reservation_button").click(function (e) {


            if (testInputs() === false) {
                alert('You did not fill out one of the fields');
                e.preventDefault();
            } else {

                $('#exampleModal1').show();
                setTimeout(function () {
                    $('#exampleModal1').hide();
                }, 15000);
            }
        });

                {{--jquery for adding dynamic fields in modal--}}
        var i = 1;
        var html;
        $("#add_row").click(function () {
            html = [];
            html += '<tr class="custom_table_add fields_' + i + '">';
            html += '<td><input type="text" class="form-control mt-3" name="client_name[]" /></td>';
            html += '<td><input type="radio" class="ml-3 " value="id_card"  name="document_type[][' + i + ']" />&nbsp;ID Card<br>';
            html += '<input type="radio" class=" ml-3 " value="passport" name="document_type[][' + i + ']"" />&nbsp;Passport<br>';
            html += '<input type="radio" class="ml-3 " value="other" name="document_type[][' + i + ']"" />&nbsp;Other</td>';
            html += '<td><input type="text" class="form-control mt-3" name="document_nr[]" /></td>';
            html += '<td><input type="text" class="form-control mt-3" name="document_serial_nr[]" /></td>';
            html += '<td><input type="text" class="form-control mt-3" name="nationality[]" /></td>';
            html += '<td><label class="custom-file-upload"> <input class="custom_file_input" type="file" name="image[]"/> <i class="fas fa-upload"></i></label></td>';

            html += '</tr>';
            $("#add_data").append(html);
            i++;
        });


        $('#remove_fields').click(function () {
            i = i - 1;
            //  console.log( i);
            $('.fields_' + i).remove();
        });

    </script>

    <script>
        $('#holder_reservation').click(function () {
            if ($(this).is(':checked')) {
                $('input[name=main_name]').prop("disabled", true);
                $('input[name=main_document_type]').prop("disabled", true);
                $('input[name=main_email]').prop("disabled", true);
                $('input[name=language_id]').prop("disabled", true);
                $('input[name=main_phone]').prop("disabled", true);
                $('input[name=main_document_nr]').prop("disabled", true);
                $('input[name=main_document_serial_nr]').prop("disabled", true);
                $('input[name=main_nationality]').prop("disabled", true);
                $('input[name=main_document_picture]').prop("disabled", true);
                $('input[name=main_address]').prop("disabled", true);
                $('#add_row').prop("disabled", true);
                $('#remove_fields').prop("disabled", true);
                $('.holder_message').append('<p class="holder_message_custom">All fields have been disabled!</p>');

            } else {
                $('input[name=main_name]').prop("disabled", false);
                $('input[name=main_document_type]').prop("disabled", false);
                $('input[name=main_email]').prop("disabled", false);
                $('input[name=language_id]').prop("disabled", false);
                $('input[name=main_phone]').prop("disabled", false);
                $('input[name=main_document_nr]').prop("disabled", false);
                $('input[name=main_document_serial_nr]').prop("disabled", false);
                $('input[name=main_nationality]').prop("disabled", false);
                $('input[name=main_document_picture]').prop("disabled", false);
                $('input[name=main_address]').prop("disabled", false);
                $('#add_row').prop("disabled", false);
                $('#remove_fields').prop("disabled", false);
                $('.holder_message').empty();
            }
        });
                @php
                    $apartments=\App\Apartment::all();

                @endphp
        var ddData = [
                        @foreach($apartments as $apartment)
                        @if($apartment->status !='blocked')
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