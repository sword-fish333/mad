

<!-- Modal -->
<div class="modal fade" id="editFeature-{{$feature->id}}" tabindex="-1" role="dialog" aria-labelledby="editFeature-{{$feature->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header custom_head_modal_feature">
                <h5 class="modal-title custom_modal_title" id="addApartment">Edit feature &nbsp;<i class="fas fa-highlighter"></i> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/features/edit/{{$feature->id}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-8">
                        <label for="name" class="feature_label">Change feature name(optional)</label>
                        <input type="text" name="name" class="form-control" value="{{$feature->name}}" placeholder="..." required >
                    </div>
                    <div>
                    @if($feature->icon)
                            <p class="feature_label">Current Image</p>
                        <img src="{{asset("storage/features_images/$feature->icon")}}" class="img-thumbnail" style="width:250px !important; height: auto;">
                    @else
                        <p>There is no Image available</p>
                    @endif
                    </div>
                    <div class="form-group col-md-8">
                        <label class="feature_label" for="icon">Change Image</label>
                        <input type="file" name="icon" class="form-control"   required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn "  style="color: white; background-color: rgba(60, 118, 198, 0.8);">Save changes <i class="fas fa-save"></i></button>
                </form>
            </div>
        </div>
    </div>
    <script>



        $('.star-rating input').click( function(){
            starvalue = $(this).attr('value');

            // iterate through the checkboxes and check those with values lower than or equal to the one you selected. Uncheck any other.
            for(i=0; i<=5; i++){
                if (i <= starvalue){
                    $("#radio" + i).prop('checked', true);
                } else {
                    $("#radio" + i).prop('checked', false);
                }
            }
        });
    </script>


</div>