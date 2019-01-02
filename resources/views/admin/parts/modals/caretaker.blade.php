<!-- Modal -->
<div class="modal fade" id="caretaker{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="caretaker" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header caretaker_header">
                <h5 class="modal-title caretaker_title">Modal title</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/reservations/caretaker/{{$reservation->id}}" style="margin: 30px;">
                    <label class="caretaker_label ">Choose Caretaker for the reservation</label>
                    <div class="slick_caretaker_dropdown">
                    <select id="slick_caretaker{{$reservation->id}}"   name="caretaker" ></select>
                    </div>

            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Caretaker</button>
            </div>
        </form>
    </div>
</div>
</div>
<script>
            @php
                $caretakers=\App\Admin::all()
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

    $('#slick_caretaker{{$reservation->id}}').ddslick({
        data: ddData,
        width: 300,
        imagePosition: "right",
        selectText: "Select Admin as caretaker for reservation",
        onSelected: function (data) {

        }
    });
</script>