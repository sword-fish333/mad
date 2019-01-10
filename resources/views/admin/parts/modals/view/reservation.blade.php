<!-- Modal -->
<div class="modal fade" id="viewReservationDetails-{{$reservation->id}}" tabindex="-1" role="dialog"
     aria-labelledby="viewReservationDetails-{{$reservation->id}}" aria-hidden="true" style=" z-index: 5">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white view_reservation_modal_header">
                <h5 class="modal-title">View Reservations Details</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="ml-4 mt-4" id="message{{$reservation->id}}">

                </div>
                <div class="row">

                    @if($reservation->schedule_check_in===NULL ||$reservation->schedule_check_out===NULL)
                        <div class="col-md-10 offset-1">
                            <p class="warning_info"><i class="fas fa-exclamation-triangle"></i> The reservation does not
                                have a schedule check In or Out date</p>
                        </div>
                    @endif
                    <div class="col-md-6">
                        <div class="row">
                            <p class="info_reservations">Client Name:</p>
                            <p class="data_reservation">{{$reservation->name}}</p>
                        </div>
                        <div class="row">
                            <p class="info_reservations">Client Email:</p>
                            <p class="data_reservation">{{$reservation->email}}</p>
                        </div>
                        <div class="row">
                            <p class="info_reservations">Phone: </p>
                            <p class="data_reservation">{{$reservation->phone}}</p>
                        </div>
                        <div class="row">
                            <p class="info_reservations">Check In: </p>
                            <p class="data_reservation"
                               style="color: darkred;">{{\Carbon\Carbon::parse($reservation->check_in)->format('d-M-Y h:m')}}</p>
                        </div>
                        <div class="row">
                            <p class="info_reservations">Check Out: </p>
                            <p class="data_reservation"
                               style="color: darkred;">{{\Carbon\Carbon::parse($reservation->check_out)->format('d-M-Y h:m')}}</p>
                        </div>
                        <div class="row">
                            <p class="info_reservations">Schedule Check In: </p>
                            <p class="data_reservation"
                               style="color: darkred;">{{$reservation->schedule_check_in ? \Carbon\Carbon::parse($reservation->schedule_check_in)->format('d-M-Y h:m') : 'There is no date available'}}</p>
                        </div>
                        <div class="row">
                            <p class="info_reservations">Schedule Check Out: </p>
                            <p class="data_reservation"
                               style="color: darkred;">{{$reservation->schedule_check_out ? \Carbon\Carbon::parse($reservation->schedule_check_out)->format('d-M-Y h:m') : 'There is no date available'}}</p>
                        </div>
                        <div class="row">
                            <p class="info_reservations"><u>Language in which the reservation was made: </u>
                                <span class="data_reservation"
                                      style="color: darkred;">{{$reservation->languages_id===1 ? 'Spanish' : 'English'}}</span>
                            </p>
                        </div>
                        <div class="row ml-2">
                            <p class="info_reservations">Send mail to client with caretaker info</p>
                            @if($reservation->caretaker_id!==NULL)
                                <button type="button" id="send_mail{{$reservation->id}}"
                                        class="{{$reservation->languages_id===1 ? 'btn-success' : 'btn-warning'}} btn btn-success ml-4">
                                    <b> {{$reservation->languages_id===1 ? 'in Spanish' : 'in English'}}</b> &nbsp;<i
                                            class="fas fa-mail-bulk"></i></button>

                            @else
                                <p class="text-danger ml-5">There was no caretaker selected for this reservation.
                                    Please select a caretaker for this reservation to be able to send Email</p>
                            @endif

                        </div>
                        <div class="row mt-3">
                            <p class="info_reservations col-md-8">Generate Tenancy </p>
                            <div class="ml-4">
                                <button id="generate_tenancy_spanish_pdf{{$reservation->id}}"
                                        class="btn btn-success ml-4"><b> in Spanish</b> &nbsp;<i
                                            class="fas fa-file-alt"></i></button>
                                <button id="generate_tenancy_english_pdf{{$reservation->id}}"
                                        class="btn btn-primary ml-5"><b> in English</b> &nbsp;<i
                                            class="fas fa-file-alt"></i></button>
                            </div>
                        </div>


                    </div>

                    <div class="col-md-5  ">
                        <p class="info_reservations">Document Image Id: </p>
                        @php
                            $client=\App\Person::where('id',$reservation->persons_id)->first();
                        @endphp
                        @if($client->document_picture)
                            <img src="{{asset("storage/document_photos/$client->document_picture")}}"
                                 class="img-thumbnail ml-5" style="height:150px; width: auto;">
                        @else
                            <p><strong>The Client has no <br> Image available</strong></p>
                        @endif
                        <div class=" mt-5 ">
                            <button type="button" class="btn btn-primary ml-5" data-toggle="modal"
                                    data-target="#signatureModal{{$reservation->id}}">
                                <b>Add Signature of Main Client</b> &nbsp;<i class="fas fa-signature"></i>
                            </button>
                        </div>
                        <div class=" ml-5 mt-5">

                            <p class="info_reservations"> Add Schedule Check in date and Check out date</p>

                            <div class=" schedule_data">
                                <div class="form-group">
                                    <label for="schedule_check_in">Schedule Check In</label>
                                    <input type="datetime-local" id="schedule_check_in{{$reservation->id}}"
                                           class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="schedule_check_out">Schedule Check Out</label>
                                    <input type="datetime-local" id="schedule_check_out{{$reservation->id}}"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="mt-2  ">
                                <button class="btn btn-success btn-block" id="submit_dates{{$reservation->id}}"><b>Save
                                        Dates</b> <i class="fas fa-calendar-check"></i></button>
                            </div>
                        </div>

                    </div>
                        <div class="row mt-3 ">
                            <div class="col-md-10 offset-1 mt-4" id="card_message{{$reservation->id}}">
                            <p for="card_info" class="info_reservations">Add Clients Card Data</p>
                            <div class="form-group col-md-5">
                                <label for="card_holder_name" class="card_info">Card Holder Name</label>
                                <input type="text" placeholder="..." class="form-control" id="card_name{{$reservation->id}}">
                            </div>
                            <div class="form-group col-md-5 ml-5">
                                <label for="card_holder_name" class="card_info">Card Holder Name</label>
                                <input type="text" placeholder="..." class="form-control" id="card_nr{{$reservation->id}}">
                            </div>
                            <div class="form-group col-md-5">
                                <label for="card_holder_name" class="card_info">Card Holder Name</label>
                                <input type="text" placeholder="..." class="form-control" id="card_expire_date{{$reservation->id}}">
                            </div>
                            <div class="form-group col-md-5 ml-5">
                                <label for="card_holder_name" class="card_info">Card Holder Name</label>
                                <input type="text" placeholder="..." class="form-control" id="card_secure_code{{$reservation->id}}">
                            </div>

                            <div class="form-group ">
                                <button class="btn btn-block btn-primary" id="submit_card{{$reservation->id}}">Save Card</button>
                            </div>
                        </div>
                </div>
                @php
                    $apartment=\App\Apartment::where('id',$reservation->apartment_id)->first();
                @endphp
                <div class="col-md-10 offset-1 mt-4" id="schedule_message{{$reservation->id}}">

                </div>
                <h3 class="title_apartment">Apartment</h3>
                <div class="row ml-2">
                    <div class="col-md-5">
                    <p class="info_apartment_view">Name of the apartment:
                    <span class="data_reservation">{{$apartment->name}}</span></p>
                    </div>
                    <div class="col-md-5 offset-1">
                    <p class="info_apartment_view">Address:
                    <span class="data_reservation">
                        @if(!empty($apartment->location))
                            {{$apartment->location}}
                    </span></p>
                    @else
                        <span class="lead"> There is no location available for this location</span></p>
                    @endif
                    </div>
                </div>
                @if(!empty($apartment))
                    @php
                        $apartment_photo=\App\Picture::where('apartments_id', $apartment->id)->first();
                    @endphp
                @endif


                <p class="info_reservations">Photo of the apartment:</p>
                <div class="row ml-5 my-3">
                    <div class="col-md-5">
                        @if($apartment_photo)
                            <img src="{{asset("storage/apartments_photos/$apartment_photo->filename")}}" class="ml-3"
                                 style="height:150px ; width: auto;">
                        @else
                            <p>There is no Image available</p>

                        @endif
                    </div>
                    <div class="col-md-3 offset-3">
                        <p><span class="info_reservations">Stars:&nbsp;</span>{{$apartment->stars}}&nbsp;<span
                                    style="color:darkred !important;"><i class="fas fa-star"></i></span></p>
                    </div>
                </div>


                @if(!empty($apartment))
                    <div class="row ml-3">
                        <div class="col-md-10">
                            <p><span class="info_reservations">Description:&nbsp;</span>{{$apartment->description}}</p>

                        </div>

                    </div>
                @endif
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close &nbsp;<i
                            class="fas fa-times"></i></button>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $('#submit_card{{$reservation->id}}').on('click', function () {
        if (confirm('Are you sure you want to add this dates, The previous dates will be overridden')) {
            var card_name = $('#card_name{{$reservation->id}}').val();
            var card_nr = $('#card_nr{{$reservation->id}}').val();
            var card_expire_date = $('#card_expire_date{{$reservation->id}}').val();
            var card_secure_code = $('#card_secure_code{{$reservation->id}}').val();


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "get",
                url: '/admin/reservations/card/add/' +{{$reservation->id}},
                data: {card_name: card_name, card_nr: card_nr,card_expire_date: card_expire_date,card_secure_code: card_secure_code,},
                success: function (data) {
                    if (data[0] === 'error') {
                        $("#card_message{{$reservation->id}}").append('<div class="alert alert-danger  text-center' +
                            ' alert-dismissible fade show" role="alert"> <strong>Danger!&nbsp;</strong>' + data[1] + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span></button></div>');


                    } else {
                        $("#card_message{{$reservation->id}}").append('<div class="alert alert-success  text-center' +
                            ' alert-dismissible fade show" role="alert"> <strong>Success!&nbsp;</strong>' + data + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span></button></div>');

                        setTimeout(function () {
                            $('#card_message{{$reservation->id}}').empty();
                        }, 4000);
                    }
                }
            });
        }
    });

    $('#submit_dates{{$reservation->id}}').on('click', function () {
        if (confirm('Are you sure you want to add this dates, The previous dates will be overridden')) {
            var schedule_check_in = $('#schedule_check_in{{$reservation->id}}').val();
            var schedule_check_out = $('#schedule_check_out{{$reservation->id}}').val();


            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "get",
                url: '/admin/reservations/schedule/add/' +{{$reservation->id}},
                data: {schedule_check_in: schedule_check_in, schedule_check_out: schedule_check_out},
                success: function (data) {
                    if (data[0] === 'error') {
                        $("#schedule_message{{$reservation->id}}").append('<div class="alert alert-danger  text-center' +
                            ' alert-dismissible fade show" role="alert"> <strong>Danger!&nbsp;</strong>' + data[1] + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span></button></div>');


                    } else {
                        $("#schedule_message{{$reservation->id}}").append('<div class="alert alert-success  text-center' +
                            ' alert-dismissible fade show" role="alert"> <strong>Success!&nbsp;</strong>' + data + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span></button></div>');

                        setTimeout(function () {
                            $('#schedule_message{{$reservation->id}}').empty();
                        }, 4000);
                    }
                }
            });
        }
    });

    $('#send_mail{{$reservation->id}}').on('click', function () {
        if (confirm('Are you sure you want to send an Email to the Client ? An email was alread y send when the caretaker was choosen.')) {
            $.ajax({
                type: "GET",
                url: '/admin/mail/caretaker/' +{{$reservation->id}},

                success: function (data) {
                    if (data[0] === 'error') {
                        $("#message{{$reservation->id}}").append('<div class="alert alert-danger col-md-11 text-center' +
                            ' alert-dismissible fade show" role="alert"> <strong>Danger!&nbsp;</strong>' + data[1] + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span></button></div>');

                        setTimeout(function () {
                            $('#message{{$reservation->id}}').empty();
                        }, 5000);
                    } else {
                        $("#message{{$reservation->id}}").append('<div class="alert alert-success col-md-11 text-center' +
                            ' alert-dismissible fade show" role="alert"> <strong>Success!&nbsp;</strong>' + data + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                            '<span aria-hidden="true">&times;</span></button></div>');

                        setTimeout(function () {
                            $('#message{{$reservation->id}}').empty();
                        }, 4000);
                    }
                }
            });
        }
    });


    $("#generate_tenancy_spanish_pdf{{$reservation->id}}").click(function () {
        $('#exampleModal1').show();

        $.ajax({
            type: "GET",
            url: '/admin/reservations/pdf/tenancy/spanish/' +{{$reservation->id}},
            xhrFields: {
                responseType: 'blob'
            },
            success: function (response, status, xhr) {
                $('#exampleModal1').hide();


                var filename = "";
                var disposition = xhr.getResponseHeader('Content-Disposition');

                if (disposition) {
                    var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                    var matches = filenameRegex.exec(disposition);
                    if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                }
                var linkelem = document.createElement('a');
                try {
                    var blob = new Blob([response], {type: 'application/octet-stream'});

                    if (typeof window.navigator.msSaveBlob !== 'undefined') {
                        //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                        window.navigator.msSaveBlob(blob, filename);
                    } else {
                        var URL = window.URL || window.webkitURL;
                        var downloadUrl = URL.createObjectURL(blob);

                        if (filename) {
                            // use HTML5 a[download] attribute to specify filename
                            var a = document.createElement("a");

                            // safari doesn't support this yet
                            if (typeof a.download === 'undefined') {
                                window.location = downloadUrl;
                            } else {
                                a.href = downloadUrl;
                                a.download = filename;
                                document.body.appendChild(a);
                                a.target = "_blank";
                                a.click();
                            }
                        } else {
                            window.location = downloadUrl;
                        }
                    }

                } catch (ex) {
                    console.log(ex);
                }
            }

        });
    });
    $("#generate_tenancy_english_pdf{{$reservation->id}}").click(function () {
        $('#exampleModal1').show();
        $('selector').click(false);
        $.ajax({
            type: "GET",
            url: '/admin/reservations/pdf/tenancy/english/' +{{$reservation->id}},
            xhrFields: {
                responseType: 'blob'
            },
            success: function (response, status, xhr) {
                $('#exampleModal1').hide();
                $('selector').click(true);

                var filename = "";
                var disposition = xhr.getResponseHeader('Content-Disposition');

                if (disposition) {
                    var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                    var matches = filenameRegex.exec(disposition);
                    if (matches !== null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                }
                var linkelem = document.createElement('a');
                try {
                    var blob = new Blob([response], {type: 'application/octet-stream'});

                    if (typeof window.navigator.msSaveBlob !== 'undefined') {
                        //   IE workaround for "HTML7007: One or more blob URLs were revoked by closing the blob for which they were created. These URLs will no longer resolve as the data backing the URL has been freed."
                        window.navigator.msSaveBlob(blob, filename);
                    } else {
                        var URL = window.URL || window.webkitURL;
                        var downloadUrl = URL.createObjectURL(blob);

                        if (filename) {
                            // use HTML5 a[download] attribute to specify filename
                            var a = document.createElement("a");

                            // safari doesn't support this yet
                            if (typeof a.download === 'undefined') {
                                window.location = downloadUrl;
                            } else {
                                a.href = downloadUrl;
                                a.download = filename;
                                document.body.appendChild(a);
                                a.target = "_blank";
                                a.click();
                            }
                        } else {
                            window.location = downloadUrl;
                        }
                    }

                } catch (ex) {
                    console.log(ex);
                }
            }

        });
    });

</script>