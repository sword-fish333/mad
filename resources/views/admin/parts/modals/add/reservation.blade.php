
<!-- Modal -->
<div class="modal fade" id="addReservation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header  add_reservation_modal_header">
                <h5 class="modal-title add_reservation_title" >Add Reservation</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/reservations/add" method="post" enctype="multipart/form-data">
                @csrf
                    <div class="form-group col-md-8">
                        <label for="">Person for which the reservation will be made</label>
                        <input type="text" name="main_name" class="form-control" placeholder="..." required>
                    </div>
                    <div class="form-group col-md-8">
                        <p for=""><strong><u> Document Type</u></strong></p>
                        <input type="radio" name="main_document_type" class="ml-3" value="id_card" placeholder="..." required>ID Card
                        <input type="radio" name="main_document_type" class="ml-3" value="passport" placeholder="..." required>Passport
                        <input type="radio" name="main_document_type" class="ml-3" value="other" placeholder="..." required>Other

                    </div>
                    <div class="form-group col-md-8">
                        <label for="">Email</label>
                        <input type="email" name="main_email" class="form-control" placeholder="..." required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="">Phone</label>
                        <input type="number" name="main_phone" min="0" class="form-control" placeholder="..." required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="">Document Nr</label>
                        <input type="text" name="main_document_nr" class="form-control" placeholder="..." required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="">Document Serial Nr</label>
                        <input type="number" name="main_document_serial_nr" min="0" class="form-control" placeholder="..." required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="">Nationality of The main Client</label>
                        <input type="text" name="main_nationality"  class="form-control" placeholder="..." required>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="">Document Picture</label>
                        <input type="file" name="main_document_picture" class="form-control" required>
                    </div>


                    <button type="button" id="add_input" class="btn btn-primary">Add person for reservation&nbsp;&nbsp;<i class="fas fa-plus-circle"></i></button>
            <div class="row">
                <div id="add_data" class="col-md-8 ml-5">

                </div>
                    <label class="apartment_reservation col-md-8 ml-5">Choose apartment for which you want to make<br> reservation</label>
                    <div class=" mt-2 ml-5 col-md-5" style="float: right">

                            @php
                            $apartments=\App\Apartment::all()
                            @endphp

                                    <div class="form-group">
                                    <select required name="apartment" class="form-control" >
                                        <option value="">Select an Apartment</option>
                                        @foreach($apartments as $apartment)
                                        <option value="{{$apartment->id}}">{{$apartment->location}}

                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                    </div>
                <div class="col-md-6">
                        <div class="form-group ">
                            <label for=""><u>Check In</u></label>
                            <input type="datetime-local" name="check_in" class="form-control" autocomplete="off" required>
                        </div>
                <div class="form-group ">
                    <label for=""><u>Check Out</u></label>
                    <input type="datetime-local" name="check_out" class="form-control" autocomplete="off" required>
                </div>
                </div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close &nbsp;<i class="fas fa-times"></i></button>
                <button type="submit" class="btn btn-primary">Save Data &nbsp;<i class="fas fa-save"></i></button>
                </form>
            </div>
        </div>
    </div>
        <script>

            $("#add_input").click(function() {
                $("#add_data").append('<label class="mt-3"><u>Name:</u></label>');
                $("#add_data").append('<input type="text" class="form-control mt-3" name="client_name[]" />');
                $("#add_data").append('<div><label class="mt-3"><u><strong>Document Type(You may choose only one):</u></strong></label>');
                $("#add_data").append('<input type="checkbox" class="  ml-3" value="id_card" name="document_type[]" />&nbsp;ID Card');
                $("#add_data").append('<input type="checkbox" class="  ml-3" value="passport" name="document_type[]" />&nbsp;Passport');
                $("#add_data").append('<input type="checkbox" class="  ml-3" value="other" name="document_type[]" />&nbsp;Other</div>');
                $("#add_data").append('<div><label class="mt-3"><u>Document Nr:</u></label></div>');
                $("#add_data").append('<input type="text" class="form-control mt-3" name="document_nr[]" />');
                $("#add_data").append('<label class="mt-3"><u>Document Serial Nr:</u></label>');
                $("#add_data").append('<input type="text" class="form-control mt-3" name="document_serial_nr[]" />');
                $("#add_data").append('<label class="mt-3"><u>Nationality:</u></label>');
                $("#add_data").append('<input type="text" class="form-control mt-3" name="nationality[]" />');
                $("#add_data").append('<label class="mt-3"><u>Document Image:</u></label>');
                $("#add_data").append('<input type="file" class="form-control mt-3" name="image[]" />');
                $('#add_data').append('<hr>');
           i++;
            });
        </script>
</div>