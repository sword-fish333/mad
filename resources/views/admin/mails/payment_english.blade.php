<img src="{{base_path().'public/images/madrent_logo.jpg'}}" style="margin-left: 100px; width: 150px; height: auto">
<h2><b>Dear</b> {{$client->name}}</h2>
<p>We have received your request regarding your booking. We recommend you to check the details of the apartment on our
    web site https://www.madreamsrent.com/en/………</p>
<h3>Payments</h3>
<p>If you have not yet paid for the reservation, you can recover the details of your request and continue the
    reservation payment process by clicking on the following link. Once the amount has been paid you will receive a
    confirmation e-mail:
    <br><br>
    https://www.madreamsrent.com/payments/new?booking_id=c21b5e79-0fd5-4af3.........
    <br><br>
    If you have paid via credit card or PayPal, you will receive an e-mail confirming the reservation of the apartment.
    No further action is required.
    <br><br>
    If you have chosen to pay by Bank Transfer we will confirm the reservation as soon as we receive the bank transfer
    receipt from you.</p>
<h3><b>Details:</b></h3>
<h4><b>BUDGET</b></h4>
<p><b>Name: </b>{{$client->name}}</p>
<p><b>Phone: </b>{{$client->phone}}</p>
<p><b>Email: </b>{{$client->email}}</p>
<h3><b>Request details: </b></h3>
<p><b>Apartment: </b>{{$apartment->name}}</p>
<p><b>Check-In: </b>{{$reservation->check_in}}</p>
<p><b>Check-Out: </b>{{$reservation->check_out}}</p>
<p><b>Guests: </b>{{$guests_nr}}</p>
<p><b>Total: </b>{{$total}}</p>
<p>For any questions, do not hesitate to contact us:  info@madreamsrent.com  </p>
<h3><u>Madreams Rent Team</u></h3>