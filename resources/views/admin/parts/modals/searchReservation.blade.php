
<!-- Modal -->
<div class="modal fade" id="searchReservation" tabindex="-1" role="dialog" aria-labelledby="searchReservation" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header search_modal_header">
                <h5 class="modal-title search_title" >Search reservation &nbsp; <i class="fas fa-search"></i></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/reservations/search" class=" ml-4">
                    <div class="row">
                    <div class="col-md-12">
                    <p class="search_info">Insert the data for which you want the search to be made</p>
                    </div>
                    <div class="form-group col-md-5">
                        <label for="name" class="label_search">Name:</label>
                        <input type="text" name="name" placeholder="..." class="form-control">
                    </div>
                    <div class="form-group col-md-5 offset-1">
                        <label for="email" class="label_search">Email:</label>
                        <input type="text" name="email" placeholder="..." class="form-control">
                    </div>
                    <div class="form-group col-md-5 ">
                        <label for="phone" class="label_search">Phone:</label>
                        <input type="text" name="phone" placeholder="..." class="form-control">
                    </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="check_in">Check In</label>
                            <input type="date" class="form-control" name="check_in">
                        </div>
                        <div class="form-group col-md-5 offset-1">
                            <label for="check_out">Check Out</label>
                            <input type="date" class="form-control" name="check_out">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Make Search</button>
                </form>
            </div>
        </div>
    </div>
</div>