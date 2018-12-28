<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
        text-align: center;
        padding: 5px;
    }

</style>

        <h1 style="margin-top: 30px"><center>Reservation Invoice</center></h1>
<div style="margin-left: 30px;">
    <h2 style=" margin-top: 30px; margin-bottom: 30px"><i><u>MadreamRent</u></i></h2>
    <h3>Client name:  <span style="font-weight: bold">{{$reservation->name}}</span></h3>
    <h3>Client email:  <span style="font-weight: bold">{{$reservation->email}}</span></h3>
    <h4>Check In: <span>{{\Carbon\Carbon::parse($reservation->check_in)->format('d-m-Y')}}</span></h4>
    <h4>Check Out: <span>{{\Carbon\Carbon::parse($reservation->check_out)->format('d-m-Y')}}</span></h4>
    @php
    $person=\App\Person::where('id', $reservation->persons_id)->first();
    @endphp
    <h4>Document Nr: <span>{{$person->document_nr}}</span></h4>
    <h4>Document Serial Nr: <span>{{$person->document_serial_nr}}</span></h4>
    <h4>Nationality: <span>{{$person->nationality}}</span></h4>

</div>
<div style="margin:auto; width: 500px;">

    @php
        $day=\Carbon\Carbon::parse($reservation->check_in);
    @endphp
    @php
        $day_nr=1
    @endphp

    @while($day <= $reservation->check_out)
        <div style=" margin-top: 50px;">

            <div>
                <table style="margin-top: 10px;">
                    <thead>
                    <tr> <td colspan="6" style="text-align: left; padding-left: 20px !important;"> {{$day_nr}}.   <strong>{{\Carbon\Carbon::parse($day)->format('d-m-Y')}}</strong></td></tr>
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
                        <td colspan="5"><strong>{{$total_price}}</strong></td>
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