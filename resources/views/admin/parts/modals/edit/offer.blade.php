<!-- Modal -->
<div class="modal fade" id="editOffer{{$offer->id}}" tabindex="-1" role="dialog" aria-labelledby="addStaticPage" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header offer_edit_header ">
                <h5 class="modal-title add_page_title_modal text-white" id="exampleModalLabel">Edit Offer &nbsp;<i class="fas fa-marker"></i></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/offers/edit/{{$offer->id}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row ml-5 mt-4">
                        <div class="col-md-5 ">
                            <div class=" form-group mt-2">
                                <label for="title" class="label_add_page">Name of the Place&nbsp;<i class="fas fa-glass-cheers"></i></label>
                                <input type="text"  class="form-control" placeholder="..." autocomplete="off"  value="{{$offer->name}}" name="name">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <p class="label_add_page">Current Image</p>
                            @if($offer->image)
                                <img src="{{asset("storage/offers_images/$offer->image")}}" class="" style="width:150px !important; height: auto;">
                            @else
                                <p style="color: darkred">there is no image available</p>
                            @endif
                            <div class="form-group mt-2 mb-4">

                                <label for="image" class="label_add_page">Chage Image if you Want</label>

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
                                    <input type="number" step="0.001" min="0" class="form-control col-md-4" id="discount{{$offer->id}}" value="{{$offer->discount}}" name="discount"  aria-describedby="coins percent">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="percent">%</span>
                                    </div>
                                    <span class="ml-3 mt-2"><input type="checkbox" name="free_discount" {{$offer->discount==='free' ? 'checked' : ''}} value="free" id="free_offer{{$offer->id}}">&nbsp; Free</span>
                                </div>
                            </div>

                            <div class=" form-group">
                                <label for="" class="label_add_page">Link of the Restaurant </label>
                                <input type="text" class="form-control" placeholder="http://" name="link" value="{{$offer->restaurant_url}}">
                            </div>
                        </div>
                        <div class="col-md-6 mt-3 ">
                            <div class="form-group ml-1">
                                <label for="description" class="label_add_page">Description of the Offer</label>
                                <textarea cols="20" rows="10" class="form-control wysiwyg"  name="description"   >{{$offer->description}}</textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Edited Offer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        if ($('#free_offer{{$offer->id}}').is(':checked')) {
            $("#discount{{$offer->id}}").attr("disabled", true); //Disable all with the same name
        } else {
            $("#discount{{$offer->id}}").attr("disabled", false); //Disable all with the same name
        }
        $("#discount{{$offer->id}}").on('input', function () {

            if ($(this).val().length > 0) {
                $('#free_offer{{$offer->id}}').attr('disabled', true);

            }
            else {
                $('#free_offer{{$offer->id}}').attr('disabled', false);
            }
        });
        $("#free_offer{{$offer->id}}").click(function () {
            if ($(this).is(':checked')) {
                $("#discount{{$offer->id}}").attr("disabled", true); //Disable all with the same name
            } else {
                $("#discount{{$offer->id}}").attr("disabled", false); //Disable all with the same name

            }
        });
    });
</script>

