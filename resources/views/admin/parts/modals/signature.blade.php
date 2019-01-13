
<!-- Modal -->
<div class="modal fade" id="signatureModal{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="signatureModal{{$reservation->id}}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header signature_header">
                <h5 class="modal-title signature_title" >Signature of the main client <i class="fas fa-file-signature"></i></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="message_signature{{$reservation->id}}">

                </div>
                @if($reservation->signature)
                    <div class="col-md-10">
                    <p class="warning_info">There is already a signature for this reservation in the database.
                        <br><b style="color:#000;"><u>If you want you can override it</u></b>
                    </p>
                    </div>
                    @endif
                <div id="signArea{{$reservation->id}}" class="sign_area">
                    <h2 class="tag-info">Put signature below,</h2>
                    <div class="sig sigWrapper" style="height:auto;">
                        <div class="typed"></div>
                        <canvas class="sign-pad" id="sign-pad" width="350" height="200"></canvas>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" id="btnSaveSign{{$reservation->id}}" class="btn btn-primary">Save Signature</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#signArea{{$reservation->id}}').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:200});
    $("#btnSaveSign{{$reservation->id}}").click(function(e){
        confirm('Are you sure you want to save this signature')
        {
            html2canvas([document.getElementById('sign-pad')], {
                onrendered: function (canvas) {
                    var canvas_img_data = canvas.toDataURL('image/png');
                    var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
                    //ajax call to save image inside folder
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '/admin/reservations/save/signature/' +{{$reservation->id}},
                        type: 'post',
                        data: {img_data: img_data},
                        dataType: 'json',
                        success: function (response) {
                            console.log(response);
                            $(".message_signature{{$reservation->id}}").append('<div class="alert alert-success col-md-11 text-center' +
                                ' alert-dismissible fade show" role="alert"> <strong>Success!&nbsp;</strong>' + response + '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
                                '<span aria-hidden="true">&times;</span></button></div>');

                            setTimeout(function () {
                                $('#message_signature{{$reservation->id}}').empty();
                                window.location.reload();
                            }, 3000);


                        }
                    });
                }
            });
        }
    });
</script>