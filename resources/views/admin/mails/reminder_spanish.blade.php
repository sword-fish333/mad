<img src="{{base_path().'public/images/madrent_logo.jpg'}}" style="margin-left: 100px; width: 150px; height: auto">
<h2><b>Estimado/a</b> {{$client->name}}</h2>
<p>Con éste e-mail, le recordamos que tiene una reserva a su nombre en las fechas más abajo indicadas.
    <b>Tenga en cuenta que el edifico no dispone de </b>, por lo cual necesitamos saber su hora de llegada a la vivienda y asi asignarle el número de teléfono de la persona que le estará esperando para la entrega de las llaves.
    Le agradecería si nos informaran cual es el  medio de transporte en el que llega a Madrid y al apartamento, indique en el caso de llegada en avión el número de vuelo y la hora de aterrizaje.
    Por favor facilitarnos su número de teléfono y tambien confirmarnos el número de personas.</p>
<h3><b>Cliente:</b></h3>
<p><b>Nombre: </b>{{$client->name}}</p>
<p><b>NIF / DNI / Pasaporte: </b>{{$client->document_nr}}</p>
<p><b>Nacionalidad: </b>{{$client->nationality}}</p>
<p><b>Dirección:  </b>{{$client->name}}</p>
<p><b>Tel:  </b>{{$client->phone}}</p>
<h3><b>Datos de la reserva:</b></h3>
<p><b>Apartamento:</b>{{$apartment->name}}</p>
<p><b>Localización: </b>{{$apartment->location}}</p>
<p><b>Fecha de entrada: </b>{{\Carbon\Carbon::parse($reservation->check_in)->format('m-d-Y')}}</p>
<p><b>Fecha de salida: </b>{{\Carbon\Carbon::parse($reservation->check_in)->format('m-d-Y')}}</p>
<p><b>Hora de entrada: </b></p>
<p><b>Hora de salida: </b></p>
<p><b>Personas: {{$guests_nr}}</b></p>
<p><b>Reserva</b></p>
<p><b>Pago pendiente: </b></p>
<p><b>Fianza/depósito: </b></p>
<br><br>
<p>Para cualquier duda no hesite en contactarnos:  info@madreamsrent.com </p>
<h3><u>El equipo de Madreams Rent</u></h3>