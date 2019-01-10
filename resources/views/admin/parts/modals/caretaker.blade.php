<!-- Modal -->
<div class="modal fade" id="caretaker{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="caretaker"
     aria-hidden="true" style="z-index: 1;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header caretaker_header">
                <h5 class="modal-title caretaker_title">Caretaker &nbsp; <i class="fas fa-screwdriver"></i></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="ml-4 mt-4" id="message_caretaker{{$reservation->id}}">
                </div>
                <label class="caretaker_label ">Choose Caretaker for the reservation <strong style="color: darkred">(The
                        old caretaker will be overridden)</strong><br>
                    <strong style="color:darkred;">An email will be send to the client with this information</strong>
                </label>
                @php
                    $caretakers=\App\Admin::all();
                @endphp
                <div style="overflow-y: auto; height: 250px" class="col-md-10">
                    @foreach($caretakers as $caretaker)
                        <input type="radio" name="caretaker" class="caretaker_{{$reservation->id}}"
                               value="{{$caretaker->id}}">&nbsp; <span
                                class="style_caretaker">{{$caretaker->name}}</span>
                        <hr>
                    @endforeach
                </div>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="submit_caretaker{{$reservation->id}}" class="btn btn-primary">Save Caretaker
                </button>
            </div>
        </div>
    </div>
</div>
<script>


    $('#submit_caretaker{{$reservation->id}}').on('click', function () {

        care_taker = $('input[name="caretaker"]:checked').val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

            type: "post",
            url: '/admin/reservations/caretaker/' +{{$reservation->id}},
            data: {caretaker: care_taker},
            beforeSend: function () {
                $('#exampleModal1').show();
            },
            success: function (data) {
                if (data[0] === 'error') {
                    $("#message_caretaker{{$reservation->id}}").append('<div class="alert alert-danger col-md-11 text-center' +
                        ' alert-dismissible fade show" role="alert"> <strong>Danger!&nbsp;</strong>' + data[1] + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span></button></div>');

                    setTimeout(function () {
                        location.reload();
                    }, 5000);
                } else {
                    $("#message_caretaker{{$reservation->id}}").append('<div class="alert alert-success col-md-11 text-center' +
                        ' alert-dismissible fade show" role="alert"> <strong>Success!&nbsp;</strong>' + data + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                        '<span aria-hidden="true">&times;</span></button></div>');

                    setTimeout(function () {
                        location.reload();
                    }, 4000);
                }
            },
            complete: function () {
                $('#exampleModal1').hide();
            }
        });
    });


</script>