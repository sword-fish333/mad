

<!-- Modal -->
<div class="modal fade" id="editFeature-{{$feature->id}}" tabindex="-1" role="dialog" aria-labelledby="editFeature-{{$feature->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header custom_head_modal_feature">
                <h5 class="modal-title custom_modal_title" id="addApartment">Edit feature &nbsp;<i class="fas fa-highlighter"></i> </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/features/edit/{{$feature->id}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-5">
                    <div class="form-group">
                        <label for="name" class="feature_label">Change feature name(optional)</label>
                        <input type="text" name="name" class="form-control" value="{{$feature->name}}" placeholder="..." required >
                    </div>
                        <div class="offset-1">
                            <span class="feature_label">Current icon:</span>
                            @if($feature->icon)
                                <i class="fas mt-5 ml-3 {{$feature->icon}} fa-3x el_ic"></i>
                            @else
                                <p>There is no Image available</p>
                            @endif

                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="feature_label offset-1 mb-3" for="icon">Change Icon if you want</label>
                        <div class="offset-1  row ">

                            <input type="radio" class="col-md-3" value="fas fa-fire " name="icon" >&nbsp;<i
                                    class="fas fa-fire el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-fire-extinguisher" name="icon" >&nbsp;<i
                                    class="fas fa-fire-extinguisher el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-apple-alt" name="icon" >&nbsp;<i
                                    class="fas fa-apple-alt el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-book-open" name="icon" >&nbsp;<i
                                    class="fas fa-book-open el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-anchor" name="icon" >&nbsp;<i
                                    class="fas fa-anchor el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fab fa-avianex" name="icon" >&nbsp;<i
                                    class="fab fa-avianex el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-bed" name="icon" >&nbsp;<i
                                    class="fas fa-bed el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-tv" name="icon" >&nbsp;<i
                                    class="fas fa-tv el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-laptop" name="icon" >&nbsp;<i
                                    class="fas fa-laptop el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-wifi" name="icon" >&nbsp;<i
                                    class="fas fa-wifi el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-headphones" name="icon" >&nbsp;<i
                                    class="fas fa-headphones el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-fire-extinguisher" name="icon" >&nbsp;<i
                                    class="fas fa-swimmer el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-swimmer" name="icon" >&nbsp;<i
                                    class="fas fa-water el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fas fa-cookie" name="icon" >&nbsp;<i
                                    class="fas fa-cookie el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fas fa-utensils" name="icon" >&nbsp;<i
                                    class="fas fa-utensils el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fas fa-person-booth" name="icon" >&nbsp;<i
                                    class="fas fa-person-booth el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-person-booth" name="icon" >&nbsp;<i
                                    class="fas fa-cat el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas  fa-cat" name="icon" >&nbsp;<i
                                    class="fas fa-fish el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas  fa-broom" name="icon" >&nbsp;<i
                                    class="fas fa-broom el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-table-tennis" name="icon" >&nbsp;<i
                                    class="fas fa-table-tennis el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-hand-holding-heart" name="icon" >&nbsp;<i
                                    class="fas fa-hand-holding-heart el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-gift " name="icon" >&nbsp;<i
                                    class="fas fa-gift el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-spa" name="icon" >&nbsp;<i
                                    class="fas fa-spa el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-taxi" name="icon" >&nbsp;<i
                                    class="fas fa-taxi el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-glass-martini-alt" name="icon" >&nbsp;<i
                                    class="fas fa-glass-martini-alt el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fab fa-playstation" name="icon"
                                   required>&nbsp;<i class="fab fa-playstation el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-suitcase" name="icon" >&nbsp;<i
                                    class="fas fa-suitcase el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-bus" name="icon" >&nbsp;<i
                                    class="fas fa-bus el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-monument" name="icon" >&nbsp;<i
                                    class="fas fa-monument el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-plane-arrival" name="icon" >&nbsp;<i
                                    class="fas fa-plane-arrival el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-credit-card  " name="icon" >&nbsp;<i
                                    class="fas fa-credit-card  el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fab fa-ethereum " name="icon" >&nbsp;<i
                                    class="fab fa-ethereum el_ic"></i><br>
                            <input type="radio" class="col-md-3" value="fas fa-concierge-bell" name="icon" >&nbsp;<i
                                    class="fas fa-concierge-bell el_ic"></i><br>
                        </div>
                    </div>

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