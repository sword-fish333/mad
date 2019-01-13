<!-- Modal -->
<div class="modal fade" id="addOffer" tabindex="-1" role="dialog" aria-labelledby="addStaticPage" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header offer_add_header ">
                <h5 class="modal-title add_page_title_modal text-white" >Add Special Offer &nbsp;<i class="fas fa-gift"></i></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/offers/add" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row ml-5 mt-4">
                        <div class="col-md-5 ">
                            <div class=" form-group mt-2">
                            <label for="title" class="label_add_page">Name of the Place&nbsp;<i class="fas fa-glass-cheers"></i></label>
                            <input type="text"  class="form-control" placeholder="..." autocomplete="off"  required name="name">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group mt-2 mb-4">
                                <label for="image" class="label_add_page">Image</label>

                                        <input type="file" name="image" class="form-control" id="chooseFile" >

                            </div>
                        </div>
                        <div class="col-md-5 mt-3">
                            <div class="form-group">
                                <label for="discount" class="label_add_page">Discount <span style="color: darkred">(You can enter one or the other but not both)</span> </label>
                                <div class="input-group mb-3" >
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="coins"><i class="fas fa-coins"></i></span>
                                    </div>
                                    <input type="number" step="0.001" min="0" class="form-control col-md-4" id="discount" name="discount" required aria-describedby="coins percent">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="percent">%</span>
                                    </div>
                                    <span class="ml-3 mt-2"><input type="checkbox" name="free_discount"  value="free" id="free_offer">&nbsp; Free</span>
                                </div>
                                </div>

                        <div class=" form-group">
                            <label for="" class="label_add_page">Link of the Restaurant </label>
                            <input type="text" class="form-control" placeholder="http://" name="link">
                        </div>
                        </div>
                        <div class="col-md-6 mt-3 ">
                            <div class="form-group ml-1">
                                <label for="description" class="label_add_page">Description of the Offer</label>
                                <textarea cols="20" rows="10" class="form-control "  name="description"   ></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Offer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $("#discount").on('input', function() {

        if($(this).val().length>0) {
            $('#free_offer').attr('disabled', true);

        }
        else {
            $('#free_offer').attr('disabled', false);
        }
    });
    $("#free_offer").click(function(){
        if($(this).is(':checked')) {
            $("input[name='discount']").attr("disabled", true); //Disable all with the same name
        }else{
            $("input[name='discount']").attr("disabled", false); //Disable all with the same name

        }
    });
</script>
