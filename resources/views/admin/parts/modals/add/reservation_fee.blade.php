<!-- Modal -->
<div class="modal fade mr-4" id="addFee{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="addFee" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header fee_header">
                <h5 class="modal-title fee_modal_title" >Add reservation Fee &nbsp; <i class="fas fa-file-invoice-dollar"></i></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/reservations/fee/add/{{$reservation->id}}" method="post" >
                    @csrf
                    <div class="row">
                    <div class="form-group col-md-5 ml-4">
                        <label for="" class="fee_info">Name of the fee:</label>
                        <input type="text" class="form-control" name="name" placeholder="..." required>
                    </div>

                        <div class="form-group col-md-6">
                            <label for="description" class="fee_info">Description:</label>
                            <textarea type="text" class="form-control" name="description" required></textarea>
                        </div>

                        <div class="form-group col-md-5 ml-4">
                            <p for="value" class="fee_info">Value</p>
                            <input type="number" step="0.001" name="value" class="form-control" min="0" placeholder="...." required >
                        </div>
                        <fieldset style="margin-top: 55px;">
                            <input type="radio" name="type_of_value" value="%" required><strong>%</strong>
                            <input type="radio" name="type_of_value" class="ml-3" value="u.m." required><strong>u.m.</strong>
                        </fieldset>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Fee &nbsp;<i class="fas fa-save"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>