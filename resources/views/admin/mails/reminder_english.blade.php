<img src="{{base_path().'public/images/madrent_logo.jpg'}}" style="margin-left: 100px; width: 150px; height: auto">
<h2><b>Dear</b> {{$client->name}}</h2>
<p>This e-mail will serve as a reminder that there is a reservation under your name on the dates indicated below.
    <b>Please bear in mind that the building has no reception</b>, so we will need to know your time of arrival in advance, in order to assign you the telephone number of the person who will be waiting for you.
    We would appreciate if you inform us by what means of transport you will be arriving in Madrid, and then at the apartment. Please indicate the flight number and the time of landing, in the case of arrival by plane.
    Please provide us with your telephone number and also confirm the number of guests arriving.</p>
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
<br><br>
<p>or any questions, do not hesitate to contact us:  info@madreamsrent.com  </p>
<h3><u>Madreams Rent Team</u></h3>