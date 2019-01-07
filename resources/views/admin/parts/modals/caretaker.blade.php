<!-- Modal -->
<div class="modal fade" id="caretaker{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="caretaker" aria-hidden="true">
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
                    <label class="caretaker_label ">Choose Caretaker for the reservation</label>
                    <div class="slick_caretaker_dropdown">
                    <select id="slick_caretaker{{$reservation->id}}"   name="caretaker" ></select>
                    </div>

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="submit_caretaker{{$reservation->id}}" class="btn btn-primary">Save Caretaker </button>
            </div>

    </div>
</div>
</div>
<script>
            @php
                $caretakers=\App\Admin::all();

            @endphp



    var ddData=[
                    @foreach($caretakers as $caretaker)

            {

                text: "{{$caretaker->name}}",
                value:{{$caretaker->id}},
                selected: false,
                description: "{{$caretaker->email}}",

            },


                @endforeach
        ];
var str;
    $('#slick_caretaker{{$reservation->id}}').ddslick({
        data: ddData,
        width: 300,
        imagePosition: "right",
        selectText: "Select Admin as caretaker for reservation",
        showSelectedHTML: false,
        onSelected: function(selectedData) {
            val = selectedData.selectedIndex;
            console.log(val);
            str = ddData[val].value;

        },

    });

            $('#submit_caretaker{{$reservation->id}}').on('click', function () {

                console.log(str);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "post",
                    url: '/admin/reservations/caretaker/' +{{$reservation->id}},
                        data:{caretaker:care},
                    success: function (data) {
                        if(data[0]==='error'){
                            $("#message_caretaker{{$reservation->id}}").append('<div class="alert alert-danger col-md-11 text-center' +
                                ' alert-dismissible fade show" role="alert"> <strong>Danger!&nbsp;</strong>' + data[1] + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                                '<span aria-hidden="true">&times;</span></button></div>');

                            setTimeout(function(){
                                $('#message{{$reservation->id}}').empty();
                            },5000);
                        }else {
                            $("#message_caretaker{{$reservation->id}}").append('<div class="alert alert-success col-md-11 text-center' +
                                ' alert-dismissible fade show" role="alert"> <strong>Success!&nbsp;</strong>' + data + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                '<span aria-hidden="true">&times;</span></button></div>');

                            setTimeout(function () {
                                $('#message{{$reservation->id}}').empty();
                            }, 4000);
                        }
                    }
                });
            });

</script>