<!-- Modal -->
<div class="modal fade mr-4" id="editPrice{{$apartment_cost->id}}" tabindex="-1" role="dialog" aria-labelledby="editPrice{{$apartment_cost->id}}" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header price_header_edit">
                <h5 class="modal-title price_modal_title" >Edit apartment Price &nbsp; <i class="fas fa-money-bill"></i></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-5 ml-4">
                            <p for="value" class="fee_info">Value</p>
                            <input type="number" step="0.00001" name="price" value="{{$apartment_cost->price}}" class="form-control" id="edit_price-{{$apartment_cost->id}}" min="0" placeholder="...." >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5 ml-4">
                            <p for="start_date" class="fee_info">Start Date</p>
                            <input type="date"  name="start_date" class="form-control" value="{{\Carbon\Carbon::parse($apartment_cost->start_date)->toDateString()}}" id="edit_start_date-{{$apartment_cost->id}}"  placeholder="...." >
                        </div>
                        <div class="form-group col-md-5 ml-4">
                            <p for="start_date" class="fee_info">End Date</p>
                            <input type="date"  name="end_date" class="form-control" value="{{\Carbon\Carbon::parse($apartment_cost->end_date)->toDateString()}}" id="edit_end_date-{{$apartment_cost->id}}"  placeholder="...." >
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="editPrice_{{$apartment_cost->id}}({{$apartment_cost->id}})" class="btn btn-primary">Save Cost &nbsp;<i class="fas fa-save"></i></button>

            </div>
        </div>
    </div>
</div>
<script>

    function editPrice_{{$apartment_cost->id}}(id) {
        var price=$('#edit_price-{{$apartment_cost->id}}').val();
        var start_date=$('#edit_start_date-{{$apartment_cost->id}}').val();
        var end_date=$('#edit_end_date-{{$apartment_cost->id}}').val();


        $.ajax({
            method:'post',
            url:'/admin/apartment/cost/edit/'+id,
            data:{
                price:price,
                start_date:start_date,
                end_date:end_date,

                _token:"{{csrf_token()}}"
            },
            success:function () {
                $('#editPrice{{$apartment_cost->id}} .close').click();

                loadDataCostEdit{{$apartment_cost->apartment_id}}();


            }

        })
    }

</script>