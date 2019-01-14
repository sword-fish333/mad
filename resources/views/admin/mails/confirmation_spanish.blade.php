<img src="{{asset('images/madrent_logo.jpg')}}" style="margin-left: 100px; width: 150px; height: auto">
<h2><b>Estimado/a</b> {{$client->name}}</h2>
<p>Con éste e-mail, le confirmamos que tiene una reserva a su nombre en las fechas más abajo indicadas. Así mismo, debe
    revisar las instrucciones de entrada para en su caso realizarnos cualquier consulta que pueda surgirle.</p>
<h3><b>Cliente:</b></h3>
<p><b>Nombre: </b>{{$client->name}}</p>
<p><b>NIF / DNI / Pasaporte: </b>{{$client->document_nr}}</p>
<p><b>Nacionalidad: </b>{{$client->nationality}}</p>
<p><b>Email:  </b>{{$client->name}}</p>
<p><b>Tel:  </b>{{$client->phone}}</p>
<h3><b>Datos de la reserva:</b></h3>
<p><b>Apartamento:</b>{{$apartment->name}}</p>
<p><b>Localización: </b>{{$apartment->location}}</p>
<p><b>Fecha de entrada: </b>{{\Carbon\Carbon::parse($reservation->check_in)->format('d-M-Y')}}</p>
<p><b>Fecha de salida: </b>{{\Carbon\Carbon::parse($reservation->check_in)->format('d-M-Y')}}</p>
<p><b>Hora de entrada: </b>a confirmar</p>
<p><b>Hora de salida: </b> 11:00</p>
<p><b>Personas: {{$guests_nr}}</b></p>
<p><b>Reserva:</b></p>
<p><b>Pago pendiente: </b></p>
<p><b>Fianza/depósito: </b> Facilitando un número de tarjeta válida</p>
<h2 style="margin-left: 50px;"><b>Instrucciones de entrada / salida:</b></h2>
<h4>Antes de su llegada</h4>
<p>Unos días antes de su llegada nos pondremos en contacto con usted por medio de e-mail para solicitarle la hora
    prevista de su llegada e indicarle el nombre y el teléfono de la persona que le atenderá en la vivienda. </p>
<h4>Entrada</h4>
<p>A la hora previamente coordinada, un miembro de nuestro personal le estará esperando en la vivienda para proporcionarle llaves de la misma y el contrato de alquiler de temporada, una de cuyas copias deberá ser firmada por usted. También le explicará el funcionamiento de los electrodomésticos existentes.
    El deposito deberá realizarse facilitando un numero de una tarjeta de crédito valida.
    La entrada en la vivienda se realizará a partir de las 15 horas. Las entradas a partir de las 22 horas llevarán un suplemento de 30 € abonados en efectivo a su llegada.</p>
<h4>Salida</h4>
<p>La salida se realizará antes de las 11 de la mañana, salvo especificación en contrario.</p>
<br><br>
    <p>Para cualquier duda no hesite en contactarnos:  info@madreamsrent.com</p>
<h4><u>El equipo de Madreams Rent</u></h4>