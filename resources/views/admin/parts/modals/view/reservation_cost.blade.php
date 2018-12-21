
<!-- Modal -->
<div class="modal fade" id="reservationCost{{$reservation->id}}" tabindex="-1" role="dialog" aria-labelledby="reservationCost{{$reservation->id}}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header reservation_cost_header">
                <h5 class="modal-title reservation_cost_title" ><u> Reservation Cost</u> <i class="far fa-money-bill-alt"></i></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover">
                    <thead class="bg-dark text-white custom_price_view_table">
                    <tr>
                        <th>Price Origin</th>
                        <th>Price</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                    </tr>
                    </thead>
                    @php
                    $ap=\App\Apartment::where('id', $reservation->apartment_id)->first();
                    $prices_ap=\App\ApartmentCost::where('apartment_id', $ap->id)->get();
                    $fees_ap=\App\ApartmentFee::where('apartment_id', $ap->id)->get();
                    $reservation_fees=\App\BookingFee::where('reservation_id', $reservation->id)->get();
                    @endphp
                    <tbody>
                    <td class="custom_td" rowspan="{{count($prices_ap)+1}}" >Prices of the <br> apartment </td>
                    @foreach($prices_ap as $price_ap)

                    <tr>
                        <td>{{$price_ap->price}}</td>
                        <td>{{\Carbon\Carbon::parse($price_ap->start_date)->toDateString()}}</td>
                        <td>{{\Carbon\Carbon::parse($price_ap->end_date)->toDateString()}}</td>
                    </tr>
                        @endforeach
                    <td class="custom_td" rowspan="{{count($fees_ap)+1}}" >Fees for the <br> apartment </td>
                    @foreach($fees_ap as $fee_ap)
                            <tr>
                            <td colspan="3" class="text-center">
                                <strong>{{$fee_ap->value}} {{$fee_ap->type_of_value}}</strong>
                            </td>
                            </tr>
                        @endforeach
                    <td class="custom_td" rowspan="{{count($reservation_fees)+1}}" >Fees of the <br> reservation </td>
                    @foreach($reservation_fees as $reservation_fee)
                                <tr>
                            <td colspan="3" class="text-center">
                                <strong>{{$reservation_fee->value}} {{$reservation_fee->type_of_value}}</strong>
                            </td>
                            </tr>
                    @endforeach
                    <td class="custom_td">Total</td>
                    <td colspan="3" class=" custom_result">
                        @php
                        $t=1;
                        foreach($prices_ap as $price_ap){
                                  $t+=$price_ap->price;
                        }
                        foreach($fees_ap as $fee_ap){

                                if($fee_ap->type_of_value==='u.m.'){
                                  $t+=$fee_ap->value;
                                  }else if($fee_ap->type_of_value==='%'){
                                  $t=$t*($fee_ap->value/100);
                                  }
                        }
                         foreach($reservation_fees as $reservation_fee){

                                if($reservation_fee->type_of_value==='u.m.'){
                                  $t+=$reservation_fee->value;
                                  }else if($reservation_fee->type_of_value==='%'){
                                  $t=$t*($reservation_fee->value/100);
                                  }
                        }
                            @endphp
                        <strong>{{$t}}</strong>
                    </td>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>