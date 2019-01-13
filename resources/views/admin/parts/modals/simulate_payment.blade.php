<!-- Modal -->
<div class="modal fade" id="simulatePayment{{$reservation->id}}" tabindex="-1" role="dialog"
     aria-labelledby="simulatePayment{{$reservation->id}}" aria-hidden="true" style="z-index:6;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Simulate payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="ml-4 mt-4" id="payment_message{{$reservation->id}}">

                </div>

                <br>
                <a href="/admin/reservations/payment/full/{{$reservation->id}}" class=" btn btn-warning mb-3" >Payment made
                    fully
                </a>
                <br>
                <a href="/admin/reservations/payment/incorrect/{{$reservation->id}}" class=" btn btn-info mb-3" >Payment could not
                    be made
                </a>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<script>

</script>