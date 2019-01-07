
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
            <div class="modal-body" style="overflow-y: scroll; height: 550px;">

                    @php
                    $day=\Carbon\Carbon::parse($reservation->check_in);
                    @endphp
                @php
                    $day_nr=1
                @endphp

                        @while($day <= $reservation->check_out)
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                             {{$day_nr}}.   {{\Carbon\Carbon::parse($day)->format('d-m-Y')}}
                            </div>
                        <div class="card-body">
                    <table class="table table-hover table-bordered">
                    <thead>
                    <tr class="custom_head_cost text-center">
                        <th>#</th>
                        <th>Cost Name</th>
                        <th>Gross Value</th>
                        <th>Monetary Value</th>
                        <th>Type of value</th>
                        <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>

                        @php
                        $cost_nr=1;
                        $reservation_prices=\App\ReservationPriceList::where('reservation_id',$reservation->id)->where('day',$day)->get();
                        @endphp
                        @foreach($reservation_prices as $reservation_price)
                            <tr class="text-center">
                        <td>{{$cost_nr}}</td>
                        <td>{{$reservation_price->name}}</td>
                                <td>{{$reservation_price->price}}</td>
                                <td>@if($reservation_price->value){{$reservation_price->value}}@else
                                    -
                                    @endif
                                </td>
                                <td>@if($reservation_price->type_of_value){{$reservation_price->type_of_value}}@else
                                        -
                                    @endif
                                </td>
                                <td>@if($reservation_price->description){{$reservation_price->description}}@else
                                        -
                                    @endif
                                </td>
                            </tr>
                            @php
                                $cost_nr++;
                            @endphp
                        @endforeach
                    <tr>
                        @php

                            $total_price=0;
                            foreach($reservation_prices as $pr){
                            if($pr->type_of_value!=='%'){
                            $total_price+=$pr->price;
                            }else{
                            $total_price=$total_price+($pr->price/100)*$total_price;
                            }
                            }
                        @endphp
                        <td class="custom_head_cost">Total</td>
                        <td colspan="5"><strong>{{number_format($total_price,2)}}</strong></td>
                    </tr>
                    </tbody>
                    </table>
                        </div>
                        </div>
                        @php
                            $day_nr++;
                        $day->addDays(1);
                        @endphp
                @endwhile

            </div>
            <div class="modal-footer">
                <a href="/admin/reservations/pdf/fee/{{$reservation->id}}" class="btn btn-success">Generate pdf Fee &nbsp; <i class="fas fa-file-invoice"></i></a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

