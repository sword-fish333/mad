<!-- Modal -->
<div class="modal fade" id="addHolder" tabindex="-1" role="dialog" aria-labelledby="addHolder" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header holder_add_header">
                <h5 class="modal-title holder_add_title" >Add Holder</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if(count(\App\Apartment::where('holder_id', NUll)->get())===0)
                    <p class="warning_holder"> There are no apartments available ! Please insert an apartment to associate it with a holder</p>
                    @endif
                <form action="/admin/holders/add" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row ml-4 mt-5">
                        <div class="form-group col-md-5 ">
                            <label for="name" class="holder_label_add">Name:</label>
                                <input type="text" name="name" class="form-control" placeholder="..." required>
                        </div>
                        <div class="form-group ml-5 col-md-5">
                            <label for="address" class="holder_label_add">Address:</label>
                            <input type="text" name="address" class="form-control" placeholder="..." required>
                        </div>
                        <div class="form-group  col-md-5">
                            <label for="email" class="holder_label_add">Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="..." required>
                        </div>
                        <div class="form-group ml-5 col-md-5">
                            <label for="email" class="holder_label_add">Phone:</label>
                            <input type="text" name="phone" class="form-control" placeholder="..." required>
                        </div>
                        <div class=" mt-5 col-md-6">
                            <p  class="holder_label_add"><strong>Select Apartments which he owns:</strong></p>
                            <div style="overflow: auto; height: 200px; width:350px; "  class="mb-5">
                                @php
                                $apartments=\App\Apartment::where('holder_id', NULL)->get();
                                @endphp
                                @foreach($apartments as $apartment)
                                    <div class="form-check" >
                                        <label class="form-check-label">

                                            <input type="checkbox" name="apartments[]" value="{{$apartment->id}}" class="form-check-input">{{$apartment->location}}
                                            <br>
                                            @php
                                                $apartment_photo=\App\Picture::where('apartments_id', $apartment->id)->first();
                                            @endphp

                                                @if($apartment_photo)
                                                    <img src="{{asset("storage/apartments_photos/$apartment_photo->filename")}}" class="" style="width:150px !important; height: auto;">
                                                @else
                                                    <p>There is no Image available</p>
                                                @endif

                                            <hr>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-md-5" style="margin-top: 70px;">
                            <label for="document_photo" class="holder_label_add">Add Document Photo <strong> (Optional)</strong></label>
                            <label class="custom-file-upload"> <input class="custom_file_input" type="file" name="document_photo"/> <i class="fas fa-upload"></i></label>
                            <div class=" form-group mt-5">
                            <label for="document_photo" class="holder_label_add">Cnp <strong>(Optional)</strong></label>
                            <input type="number" min="0" placeholder="...." name="cnp" class="form-control">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                <button type="submit" class="btn btn-primary">Save changes&nbsp;<i class="far fa-save"></i></button>

            </form>
            </div>
        </div>
    </div>
</div>
<script>
    @if(count(\App\Apartment::where('holder_id', NUll)->get())===0)
        $('input[name=name]').prop('disabled', true);
         $('input[name=address]').prop('disabled', true);
         $('input[name=email]').prop('disabled', true);
          $('input[name=phone]').prop('disabled', true);
    $('input[name=apartments]').prop('disabled', true);
    $('input[name=document_photo]').prop('disabled', true);
    $('input[name=cnp]').prop('disabled', true);
    $('button[type=submit]').prop('disabled', true);
    @endif
</script>