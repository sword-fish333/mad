<!-- Modal -->
<div class="modal fade" id="editHolder-{{$holder->id}}" tabindex="-1" role="dialog" aria-labelledby="editHolder-{{$holder->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header holder_edit_header">
                <h5 class="modal-title holder_edit_title" >Edit Holder</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/holders/add" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row ml-4 mt-5">
                        <div class="form-group col-md-5 ">
                            <label for="name" class="holder_label_add">Name:</label>
                                <input type="text" name="name" value="{{$holder->name}}" class="form-control" >
                        </div>
                        <div class="form-group ml-5 col-md-5">
                            <label for="address" class="holder_label_add">Address:</label>
                            <input type="text" name="address" value="{{$holder->address}}" class="form-control" >
                        </div>
                        <div class="form-group  col-md-5">
                            <label for="email" class="holder_label_add">Email:</label>
                            <input type="email" name="email" class="form-control" value="{{$holder->email}}">
                        </div>
                        <div class="form-group ml-5 col-md-5">
                            <label for="email" class="holder_label_add">Phone:</label>
                            <input type="text" name="phone" class="form-control" value="{{$holder->phone}}">
                        </div>
                        <div class=" mt-5 col-md-6">
                            <p  class="holder_label_add"><strong>Select Apartments which he owns:</strong></p>
                            <div style="overflow: auto; height: 200px; width:350px; "  class="mb-5">
                                @php
                                $apartments=\App\Apartment::all();
                                @endphp
                                @foreach($apartments as $apartment)
                                    <div class="form-check" >
                                        <label class="form-check-label">

                                            <input type="checkbox" name="apartments[]" value="{{$apartment->id}}" {{$apartment->holder_id===$holder->id ? 'checked' : ''}} class="form-check-input">{{$apartment->location}}
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
                            <p class="current_image_edit_holder">Current Image </p>
                            <img src="{{asset("storage/apartment_holders/$holder->document_photo")}}" class="img-thumbnail my-3 mx-3" style="width:150px !important; height: auto;">
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