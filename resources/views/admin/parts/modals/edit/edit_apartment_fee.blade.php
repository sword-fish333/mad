<!-- Modal -->
<div class="modal fade mr-4" id="editApartmentFee{{$apartment_fee->id}}" tabindex="-1" role="dialog" aria-labelledby="editApartmentFee{{$apartment_fee->id}}" aria-hidden="true" >
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
                            <input type="text" class="form-control " value="{{$apartment_fee->name}}" id="edit_fee_name-{{$apartment_fee->id}}" name="fee_name"  placeholder="..." >
                        </div>

                        <div class="form-group col-md-6">
                            <label for="description" class="fee_info">Description:</label>
                            <textarea type="text" class="form-control "  id="edit_fee_description-{{$apartment_fee->id}}" name="fee_description" >{{$apartment_fee->description}}</textarea>
                        </div>

                        <div class="form-group col-md-5 ml-4">
                            <p for="value" class="fee_info">Value</p>
                            <input type="number" step="0.00001" name="fee_value"  value="{{$apartment_fee->value}}" class="form-control" id="edit_fee_value-{{$apartment_fee->id}}" min="0" placeholder="...." >
                        </div>
                        <fieldset style="margin-top: 55px;">
                            <input type="radio" name="edit_fee_type_of_value_{{$apartment_fee->id}}"  {{$apartment_fee->type_of_value==="%" ? 'checked': ''}} value="%" ><strong>%</strong>
                            <input type="radio" name="edit_fee_type_of_value_{{$apartment_fee->id}}" {{$apartment_fee->type_of_value==="u.m." ? 'checked' : ''}} class="ml-3  " value="u.m." ><strong>u.m.</strong>
                        </fieldset>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="editFee_{{$apartment_fee->id}}({{$apartment_fee->id}})" class="btn btn-primary">Save Fee &nbsp;<i class="fas fa-save"></i></button>

            </div>
        </div>
    </div>
</div>
<script>


    function editFee_{{$apartment_fee->id}}(id) {
        var name=$('#edit_fee_name-{{$apartment_fee->id}}').val();
        var description=$('#edit_fee_description-{{$apartment_fee->id}}').val();
        var value=$('#edit_fee_value-{{$apartment_fee->id}}').val();
        var type_of_value= $('input:radio[name=edit_fee_type_of_value_{{$apartment_fee->id}}]:checked').val();

        $.ajax({
            method:'post',
            url:'/admin/apartment/fee/edit/'+id,
            data:{
                name:name,
                description:description,
                value:value,
                type_of_value:type_of_value,
                _token:"{{csrf_token()}}"
            },
            success:function (data) {

                $('#editApartmentFee{{$apartment_fee->id}} .close').click();
                d=JSON.parse(data);
                if(d['status']==='error') {

                    $(".message_fees{{$apartment_fee->apartment_id}}").addClass(' alert-danger');
                    $(".message_fee").show();
                    $('.message_fees{{$apartment_fee->apartment_id}}').append(d['info_error']);
                    setTimeout(function(){
                        $('.message_fees{{$apartment_fee->apartment_id}}').removeClass('alert-danger');
                        $('.message_fees{{$apartment_fee->apartment_id}}').empty();
                    },3000);
                }else if(d['status']==='success') {
                    $(".message_fee").show();
                    $(".message_fees{{$apartment_fee->apartment_id}}").addClass(' alert-success');
                    $('.message_fees{{$apartment_fee->apartment_id}}').append(d['info_success']);
                    setTimeout(function(){
                        $('.message_fees{{$apartment_fee->apartment_id}}').removeClass('alert-success');
                        $('.message_fees{{$apartment_fee->apartment_id}}').empty();
                    },3000);

                }

                loadDataFeeEdit{{$apartment_fee->apartment_id}}();

            }

        })
    }
</script>