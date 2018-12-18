<!-- Modal -->
<div class="modal fade mr-4" id="addApartmentFee{{$apartment->id}}" tabindex="-1" role="dialog" aria-labelledby="addApartmentFee{{$apartment->id}}" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header fee_header">
                <h5 class="modal-title fee_modal_title" >Apartment Fee &nbsp; <i class="fas fa-file-invoice-dollar"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    @csrf
                    <div class="row">
                    <div class="form-group col-md-5 ml-4">
                        <label for="" class="fee_info">Name of the fee:</label>
                        <input type="text" class="form-control " id="fee_name-{{$apartment->id}}" name="fee_name"  placeholder="..." >
                    </div>

                        <div class="form-group col-md-6">
                            <label for="description" class="fee_info">Description:</label>
                            <textarea type="text" class="form-control " id="fee_description-{{$apartment->id}}" name="fee_description" ></textarea>
                        </div>

                        <div class="form-group col-md-5 ml-4">
                            <p for="value" class="fee_info">Value</p>
                            <input type="number" step="0.00001" name="fee_value" class="form-control" id="fee_value-{{$apartment->id}}" min="0" placeholder="...." >
                        </div>
                        <fieldset style="margin-top: 55px;">
                            <input type="radio" name="fee_type_of_value_{{$apartment->id}}"  value="%" ><strong>%</strong>
                            <input type="radio" name="fee_type_of_value_{{$apartment->id}}" class="ml-3  " value="u.m." ><strong>u.m.</strong>
                        </fieldset>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="addFee_{{$apartment->id}}({{$apartment->id}})" class="btn btn-primary">Save Fee &nbsp;<i class="fas fa-save"></i></button>

            </div>
        </div>
    </div>
</div>
<script>


    function addFee_{{$apartment->id}}(id) {
        var name=$('#fee_name-{{$apartment->id}}').val();
        var description=$('#fee_description-{{$apartment->id}}').val();
        var value=$('#fee_value-{{$apartment->id}}').val();
        var type_of_value= $('input:radio[name=fee_type_of_value_{{$apartment->id}}]:checked').val();

        $.ajax({
            method:'post',
            url:'/admin/apartment/fee/add/'+id,
            data:{
                name:name,
                description:description,
                value:value,
                type_of_value:type_of_value,
                _token:"{{csrf_token()}}"
            },
            success:function (data) {
                $('#addApartmentFee{{$apartment->id}} .close').click();
                loadData{{$apartment->id}}();

            }

        })
    }
</script>