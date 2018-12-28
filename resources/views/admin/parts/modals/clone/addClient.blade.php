
<!-- Modal -->
<div class="modal fade" id="addClientToClone{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="addClientToClone{{$reservation->id}}" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="height: 650px !important;">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title add_client_clone" >Add Client <i class="fas fa-user-plus"></i> </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-5 ml-4">
                            <label for="" class="fee_info">Name:</label>
                            <input type="text" class="form-control " id="client_name-{{$reservation->id}}"   placeholder="..." >
                        </div>

                        <div class="form-group col-md-5">
                            <label for="description" class="fee_info">Client Document Nr:</label>
                            <input type="text" class="form-control " id="client_document_nr-{{$reservation->id}}"   placeholder="..." >
                        </div>

                        <div class="form-group col-md-5 ml-4 mt-4">
                            <label for="description" class="fee_info">Client Document Serial Nr:</label>
                            <input type="text" class="form-control " id="client_document_serial_nr-{{$reservation->id}}"  >
                        </div>

                        <div class="form-group col-md-5 ml-4 mt-4">
                            <p for="value" class="fee_info">Document Type:</p>
                            <input type="radio"  class="ml-3 clone_client_document_id{{$reservation->id}}" value="id_card" required>ID Card
                            <input type="radio" class="ml-3 clone_client_document_passport{{$reservation->id}}" value="passport"  required>Passport
                            <input type="radio"  class="ml-3 clone_client_document_other{{$reservation->id}}" value="other"  required>Other
                        </div>

                        <div class="form-group col-md-5 ml-4 mt-4">
                            <label for="" class="fee_info">Nationality:</label>
                            <input type="text" class="form-control " id="nationality-{{$reservation->id}}"  >
                        </div>
                        <div class="form-group col-md-5 ml-4 mt-4">
                            <label for="" class="fee_info">Document Image:</label>
                            <input type="file" class="form-control " id="document_image-{{$reservation->id}}"  >
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="addClient_{{$reservation->id}}()" class="btn btn-primary">Add Client </button>
            </div>
        </div>
    </div>
</div>
<script>

        client_n--;
    function addClient_{{$reservation->id}}(){
        html+=' ';
        var name=$('#client_name-{{$reservation->id}}').val();
        var document_nr=$('#client_document_nr-{{$reservation->id}}').val();
        var document_serial_nr=$('#client_document_serial_nr-{{$reservation->id}}').val();
        var nationality=$('#nationality-{{$reservation->id}}').val();
        var document_photo=$('#document_image-{{$reservation->id}}').val();
       if( $('.clone_client_document_id{{$reservation->id}}').is(':checked')){
            console.log(1);
                $('.check_client_id-{{$reservation->id}}').prop('checked',true);
            }


            client_n++;
            html+='<h4 class="ml-4 mt-2 client_nr"><u>'+client_n+'.</u></h4>';
            html+='<div class="row"><div class="form-group col-md-5">'+
                '<label class="add_reservation_info">Client name:</label>'+
                '<input type="text"  class="form-control" name="client_name[]"  value="'+name+'">'+
            '</div>';
        html+='<div class="form-group col-md-5">'+
            '<label class="add_reservation_info">Client Document Nr:</label>'+
            '<input type="text"  class="form-control" name="client_document_nr[]"  value="'+document_nr+'">'+
            '</div>';
        html+='<div class="form-group col-md-5">'+
            '<label class="add_reservation_info">Client Document Serial Nr:</label>'+
            '<input type="text"  class="form-control" name="client_document_serial_nr[]"  value="'+document_serial_nr+'">'+
            '</div>';
            html+='<div class="form-group col-md-6">'+
                '<p ><strong><u>Document Type(You may choose only one)</u></strong></p>'+
        '<input type="checkbox"  class="ml-3 check_client_id-{{$reservation->id}}" name="document_type[]"  value="id_card"'+
                '>&nbsp;Id Card'+
                '<input type="checkbox"  class="ml-3 check_client_passport{{$reservation->id}}"  name="document_type[]" value="passport"'+
                '>&nbsp;Passport'+
        '<input type="checkbox"  class="ml-3 check_client_other{{$reservation->id}}" name="document_type[]" value="other"'+
                '>&nbsp;Other'+
        '</div>';
        html+='<div class="form-group col-md-5">'+
            '<label class="add_reservation_info">Nationality:</label>'+
            '<input type="text"  class="form-control" name="nationality[]"  value="'+nationality+'">'+
            '</div>';
        html+='<div class="form-group col-md-5">'+
            '<label class="add_reservation_info">Nationality:</label>'+
            '<input type="file"  class="form-control" name="document_photo[]"  value="'+document_photo+'">'+
            '</div>';
        html+='</div>';
            $('.clients_zone{{$reservation->id}}').append(html);
        $('#addClientToClone{{$reservation->id}}').modal('hide');
    }


</script>