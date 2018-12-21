<!-- Modal -->
<div class="modal fade mr-4" id="addApartmentCost{{$apartment->id}}" tabindex="-1" role="dialog" aria-labelledby="addApartmentCost{{$apartment->id}}" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header price_header">
                <h5 class="modal-title price_modal_title" >Apartment Net Price for a given Period &nbsp; <i class="fas fa-money-bill"></i></h5>
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
                            <input type="number" step="0.00001" name="price" class="form-control" id="price-{{$apartment->id}}" min="0" placeholder="...." >
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5 ml-4">
                            <p for="start_date" class="fee_info">Start Date</p>
                            <input type="date"  name="start_date" class="form-control" id="start_date-{{$apartment->id}}"  placeholder="...." >
                        </div>
                        <div class="form-group col-md-5 ml-4">
                            <p for="start_date" class="fee_info">End Date</p>
                            <input type="date"  name="end_date" class="form-control" id="end_date-{{$apartment->id}}"  placeholder="...." >
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="addCost_{{$apartment->id}}({{$apartment->id}})" class="btn btn-primary">Save Cost &nbsp;<i class="fas fa-save"></i></button>

            </div>
        </div>
    </div>
</div>
<script>


    function addCost_{{$apartment->id}}(id) {
        var price=$('#price-{{$apartment->id}}').val();
        var start_date=$('#start_date-{{$apartment->id}}').val();
        var end_date=$('#end_date-{{$apartment->id}}').val();


        $.ajax({
            method:'post',
            url:'/admin/apartment/cost/add/'+id,
            data:{
                price:price,
                start_date:start_date,
                end_date:end_date,

                _token:"{{csrf_token()}}"
            },
            success:function (data) {
                $('#addApartmentCost{{$apartment->id}} .close').click();
                d=JSON.parse(data);
                if(d['status']==='error') {

                    $(".message_prices{{$apartment->id}}").addClass(' alert-danger');
                    $(".message_price").show();
                    $('.message_prices{{$apartment->id}}').append(d['info_error']);
                    setTimeout(function(){
                        $('.message_prices{{$apartment->id}}').removeClass('alert-danger');
                        $('.message_prices{{$apartment->id}}').empty();
                    },5000);
                }else if(d['status']==='success') {
                    $(".message_price").show();
                    $(".message_prices{{$apartment->id}}").addClass(' alert-success');
                    $('.message_prices{{$apartment->id}}').append(d['info_success']);
                    setTimeout(function(){
                        $('.message_prices{{$apartment->id}}').removeClass('alert-success');
                        $('.message_prices{{$apartment->id}}').empty();
                    },3000);

                }
                loadDataCost{{$apartment->id}}();

            }

        })
    }
</script>