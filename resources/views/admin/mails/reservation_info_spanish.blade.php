<img src="{{asset('public/images/madrent_logo.jpg')}}" style="margin-left: 100px; width: 150px; height: auto">
<h2><b>Estimado/a </b> {{$client->name}}</h2>
<p>Hemos recibido su petición en relación con su solicitud. Le recomendamos que consulte el detalle del apartamento en
    nuestra página web en https://www.madreamsrent.es/...(linkul cu apartamentul )........</p>
<h3>Pagos</h3>
<p>Si no ha abonado el importe de la reserva, puede recuperar los datos de su solicitud y continuar con el proceso de
    pago del importe de reserva haciendo click en el siguiente link. Una vez abonado el importe, recibirá un e-mail con
    la confirmación de la reserva:
    <br><br>
    https://www.madreamsrent.com/payments/new?booking_id=bba4dda3-bf( linkul pt plata)
    <br><br>

    Si ha realizado el pago del importe de la reserva con tarjeta de crédito o con Paypal, recibirá un e-mail en unos
    segundos confirmándole la reserva del apartamento. En éste caso, no es necesaria ninguna acción adicional por su
    parte.
    Si ha seleccionado Transferencia bancaria como medio de pago, le confirmaremos la reserva tan pronto como nos envíe
    el justificante bancario de la transferencia a esta misma dirección de e-mail.</p>
<h3><b>Detalle:</b></h3>
<h4><b>PRESUPUESTO:</b></h4>
<p><b>Nombre: </b>{{$client->name}}</p>
<p><b>Tel: </b>{{$reservation->phone}}</p>
<p><b>E-mail: </b>{{$reservation->email}}</p>
<h3><b>Datos de la solicitud: </b></h3>
<p><b>Apartamento: </b>{{$apartment->name}}</p>
<p><b>Fecha de entrada: </b>{{$reservation->check_in}}</p>
<p><b>Fecha de salida: </b>{{$reservation->check_out}}</p>
<p><b>Personas: </b>{{$guests_nr}}</p>
<p><b>Precio alojamiento: </b>{{$total}}</p>
<p>Para cualquier duda no hesite en contactarnos:  info@madreamsrent.com  </p>
<h3><u>El equipo de Madreams Rent</u></h3>