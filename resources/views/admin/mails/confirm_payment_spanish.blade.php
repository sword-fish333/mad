<div style="margin-left: 25px;">
    <p>Un cliente ha realizado una reserva mediante pago por …….(pay pal, card, transfer)
        El resultado del pago ha sido: <b>PAGO CORRECTO</b></p>
    <h3>Datos de la reserva</h3>
    <h4>Cliente</h4>
    <p><b>Nombre:</b>{{$client->name}}</p>
    <p><b>NIF / DNI / Pasaporte:</b>{{$client->document_nr}}</p>
    <p><b>Teléfono:</b>{{$reservation->phone}}</p>
    <p><b>E-mail: </b>{{$reservation->phone}}</p>
    <p><b>Comentarios: </b></p>
    <h4 style="margin-top: 15px">Reserva</h4>
    <p><b>Apartamento:</b>{{$apartment->name}}</p>
    <p><b>Check-In:</b>{{\Carbon\Carbon::parse($reservation->check_in)->format('d-M-Y')}}</p>
    <p><b>Check-Out:</b>{{\Carbon\Carbon::parse($reservation->check_out)->format('d-M-Y')}}</p>
    <p><b>Personas:</b>{{$guests_nr}}</p>
    <p>Se ha creado una reserva <b>CONFIRMADA</b> en la zona de administración. Igualmente SE HA ENVIADO POR MAIL AL
        INQUILINO UNA COPIA.</p>
    <p>Este es un correo automático desde la Web MadreamsRent.com</p>
</div>