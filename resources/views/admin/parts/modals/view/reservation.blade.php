
<!-- Modal -->
<div class="modal fade" id="viewReservationDetails-{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="viewReservationDetails-{{$reservation->id}}" aria-hidden="true"  style=" z-index: 5">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white view_reservation_modal_header">
                <h5 class="modal-title" >View Reservations Details</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="ml-4 mt-4" id="message{{$reservation->id}}">

                </div>
                <div class="row">

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
                    <p class="data_reservation" style="color: darkred;">{{\Carbon\Carbon::parse($reservation->check_in)->format('d-M-Y h:m')}}</p>
                    </div>
                        <div class="row">
                    <p class="info_reservations">Check Out: </p>
                    <p class="data_reservation" style="color: darkred;">{{\Carbon\Carbon::parse($reservation->check_out)->format('d-M-Y h:m')}}</p>
                        </div>
                        <div class="row">
                            <p class="info_reservations">Schedule Check Out: </p>
                            <p class="data_reservation" style="color: darkred;">{{\Carbon\Carbon::parse($reservation->schedule_check_in)->format('m-d-Y h:m')}}</p>
                        </div>
                        <div class="row">
                            <p class="language_label_style"><u>Language in which the  reservation  was made: </u>
                                <span class="data_reservation" style="color: darkred;">{{$reservation->languages_id===1 ? 'Spanish' : 'English'}}</span></p>
                        </div>

                    </div>
                    <div class="col-md-5  ">
                        <p class="info_reservations">Document Image Id: </p>
                        @php
                            $client=\App\Person::where('id',$reservation->persons_id)->first();
                        @endphp
                        @if($client->document_picture)
                            <img src="{{asset("storage/document_photos/$client->document_picture")}}" class="img-thumbnail ml-5" style="height:150px; width: auto;">
                        @else
                            <p><strong>The Client  has no <br>  Image available</strong></p>
                        @endif
                        <div class=" mt-5 ">
                            <button type="button" class="btn btn-primary ml-5" data-toggle="modal" data-target="#signatureModal{{$reservation->id}}">
                                <b>Add Signature of Main Client</b> &nbsp;<i class="fas fa-signature"></i>
                            </button>
                        </div>
                    </div>
                        <div >
                            <p class="info_reservations">Send mail to client with caretaker info</p>
                            @if($reservation->caretaker_id!==NULL)
                            <button type="button" id="send_mail{{$reservation->id}}" class="{{$reservation->languages_id===1 ? 'btn-success' : 'btn-warning'}} btn btn-success ml-4"><b> {{$reservation->languages_id===1 ? 'in Spanish' : 'in English'}}</b> &nbsp;<i class="fas fa-mail-bulk"></i></button>

                            @else
                                <p class="text-danger ml-5">There was no caretaker selected for this reservation <br>
                                Please select a caretaker for this reservation</p>
                            @endif

                        </div>
                    <div class="row mt-3 ml-1 ">
                        <p class="info_reservations col-md-8">Generate Tenancy </p>
                            <div>
                        <button id="generate_tenancy_spanish_pdf{{$reservation->id}}"  class="btn btn-success ml-4" ><b> in Spanish</b> &nbsp;<i class="fas fa-file-alt"></i></button>
                        <button id="generate_tenancy_english_pdf{{$reservation->id}}"   class="btn btn-primary ml-5" ><b> in English</b> &nbsp;<i class="fas fa-file-alt"></i></button>
                            </div>
                        </div>
                        </div>
                    @php
                    $apartment=\App\Apartment::where('id',$reservation->apartment_id)->first();
                    @endphp
                <h3 class="title_apartment">Apartment</h3>
                <div class="row ml-2">

                        <p class="info_reservations">Address:</p>
                    <p class="data_reservation">
                        @if(!empty($apartment->location))
                        {{$apartment->location}}
                    </p>
                            @else
                            <p class="lead"> There is no location available for this location</p>
                        @endif

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
                            <img src="{{asset("storage/apartments_photos/$apartment_photo->filename")}}" class="ml-3" style="height:150px ; width: auto;">
                                    @else
                                        <p>There is no Image available</p>

                                    @endif
                                </div>
                                    <div class="col-md-3 offset-3">
                                        <p><span class="info_reservations">Stars:&nbsp;</span>{{$apartment->stars}}&nbsp;<span style="color:darkred !important;"><i class="fas fa-star"></i></span></p>
                                    </div>
                                </div>


                @if(!empty($apartment))
                <div class="row ml-3">
                    <div class="col-md-10">
                    <p ><span class="info_reservations">Description:&nbsp;</span>{{$apartment->description}}</p>

                    </div>

                </div>
                    @endif
            </div>



                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close &nbsp;<i class="fas fa-times"></i></button>
                </div>
                </div>
            </div>
        </div>
    </div>
<script>
    $('#send_mail{{$reservation->id}}').on('click', function () {

        $.ajax({
            type: "GET",
            url: '/admin/mail/caretaker/' +{{$reservation->id}},

            success: function (data) {
                if(data[0]==='error'){
                    $("#message{{$reservation->id}}").append('<div class="alert alert-danger col-md-11 text-center' +
                        ' alert-dismissible fade show" role="alert"> <strong>Danger!&nbsp;</strong>' + data[1] + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span></button></div>');

                    setTimeout(function(){
                        $('#message{{$reservation->id}}').empty();
                    },5000);
                }else {
                    $("#message{{$reservation->id}}").append('<div class="alert alert-success col-md-11 text-center' +
                        ' alert-dismissible fade show" role="alert"> <strong>Success!&nbsp;</strong>' + data + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span></button></div>');

                    setTimeout(function () {
                        $('#message{{$reservation->id}}').empty();
                    }, 4000);
                }
            }
        });
    });


    $("#generate_tenancy_spanish_pdf{{$reservation->id}}").click(function(){
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
    $("#generate_tenancy_english_pdf{{$reservation->id}}").click(function(){
        $('#exampleModal1').show();
        $('selector').click(false);
        $.ajax({
            type: "GET",
            url: '/admin/reservations/pdf/tenancy/english/'+{{$reservation->id}},
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