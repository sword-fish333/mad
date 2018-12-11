
<!-- Modal -->
<div class="modal fade" id="viewReservationDetails-{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white view_reservation_modal_header">
                <h5 class="modal-title" id="exampleModalLabel">View Reservations Details</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                    <p class="data_reservation" style="color: darkred;">{{\Carbon\Carbon::parse($reservation->check_in)->format('Y-M-D')}}</p>
                </div>
                <div class="row">
                    <p class="info_reservations">Check In: </p>
                    <p class="data_reservation" style="color: darkred;">{{\Carbon\Carbon::parse($reservation->check_out)->format('Y-M-D')}}</p>
                </div>
                            <div class="row">
                    <p class="info_reservations">Document Image Id: </p>
                                @php
                                    $client=\App\Person::where('id',$reservation->persons_id)->first();
                                @endphp
                                    @if($client->document_picture)
                                        <img src="{{asset("storage/document_photos/$client->document_picture")}}" class="img-thumbnail ml-5" style="height:120px; width: auto;">
                                    @else
                                        <p><strong>The Client  has no <br>  Image available</strong></p>
                                @endif
                            </div>


                    @php
                    $apartment=\App\Apartment::where('id',3)->first();
                    @endphp
                <h3 class="title_apartment">Apartment</h3>
                <div class="row ml-2">

                        <p class="info_reservations">Address:</p>
                    <p class="data_reservation">{{$apartment->location}}</p>
                    </div>
                    @php
                        $apartment_photo=\App\Picture::where('apartments_id', $apartment->id)->first();
                    @endphp

                        @if($apartment_photo)
                        <div class="row">
                            <p class="info_reservations">Photo of the apartment:</p>

                            <img src="{{asset("storage/apartments_photos/$apartment_photo->filename")}}" class="ml-3" style="height:150px ; width: auto;">
                        @else
                            <p>There is no Image available</p>
                        </div>
                        @endif
                <div class="row ml-5">
                    <div class="col-md-10">
                    <p ><u class="lead">Description:&nbsp;</u>{{$apartment->description}}</p>

                    </div>
                    <div class="col-md-10">
                        <p><u class="lead">Stars:&nbsp;</u>{{$apartment->stars}}&nbsp;<span style="color:darkred !important;"><i class="fas fa-star"></i></span></p>
                    </div>
                </div>
            </div>



                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close &nbsp;<i class="fas fa-times"></i></button>

                </div>
            </div>
        </div>
    </div>