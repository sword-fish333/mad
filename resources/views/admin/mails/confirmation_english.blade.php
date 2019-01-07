<img src="{{asset('/images/madrent_logo.jpg')}}" style="width: 150px; height: auto">
<h2><b>Dear</b> {{$client->name}}</h2>
<p>We are writing in order to confirm your reservation under your name, for the dates stated below. In addition, you
    should read the check-in details in case you may have any queries.</p>
<h3><b>Customer:</b></h3>
<p><b>Name: </b>{{$client->name}}</p>
<p><b>Identity card/passport: </b>{{$client->document_nr}}</p>
<p><b>Nationality: </b>{{$client->nationality}}</p>
<p><b>Address:  </b>{{$client->name}}</p>
<p><b>Phone:  </b>{{$client->phone}}</p>
<h3><b>Reservation details:</b></h3>
<p><b>Apartment:</b>{{$apartment->name}}</p>
<p><b>Location: </b>{{$apartment->location}}</p>
<p><b>Check-in: </b>{{\Carbon\Carbon::parse($reservation->check_in)->format('m-d-Y')}}</p>
<p><b>Check-out: </b>{{\Carbon\Carbon::parse($reservation->check_in)->format('m-d-Y')}}</p>
<p><b>Check in time: </b></p>
<p><b>Check out time: </b></p>
<p><b>Guests: </b>{{$guests_nr}}</p>
<p><b>Reservation:</b></p>
<p><b>Pending charges: </b></p>
<p><b>Security deposit: </b></p>
<h2 style="margin-left: 50px;"><b>Detailed instructions for check-in/-out:</b></h2>
<h4>Before your arrival</h4>
<p>A few days before your arrival we will be contacting you by email to require your arrival details and to indicate the
    name and telephone number of the person in charge with your check-in. </p>
<h4>Check In</h4>
<p>At the prearranged time, a member of our staff will be waiting for you in the apartment to hand over the keys, and
    the rental contract for the season, which you will have to sign. They will also explain how to operate the
    appliances in the apartment.
    The deposit must be provided using a valid credit card.
    Entry to the apartment will be only after 3pm. Late check-ins (from 10pm) will incur an extra charge of 30€, paid
    cash upon arrival.</p>
<h4>Check Out</h4>
<p>You will be required to vacate the premises by 11am, unless otherwise specified.</p>
<br><br>
<p>For any questions, do not hesitate to contact us:  info@madreamsrent.com</p>
<h4><u>Madreams Rent Team</u></h4>