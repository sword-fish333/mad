<html>
<body style="margin-left: 20px;">
<img src="{{base_path().'/public/images/madrent_logo.jpg'}}" style="margin-left: 100px; width: 150px; height: auto">
<hr>
<h2>Contrato de prestación de alojamiento en vivienda de uso turístico</h2>
<h4 style="float: right; margin-right: 30px">En Madrid, a {{\Carbon\Carbon::now()->format('d-M-Y')}}.</h4>
<h5>LAS PARTES INVOLUCRADAS</h5>
<p style="margin-top: 30px">&nbsp;&nbsp;De una parte, Madreams Rent
    (quién estará aquí siendo conocido como titular), con sede en Madrid,
    y representada por D. Andrei Campeanu, mayor de edad, y provista de N.I.F.
    Y1695604 N, que actúa como parte arrendadora y representante del titular de

    la vivienda de uso turístico sita en Calle <span><b>{{$apartment->location}}</b></span>, Madrid, España.</p>
<p>De otra parte, D/Dª <b>{{$client->name}}</b>.(quién estará aquí siendo conocido como usuario) mayor de edad, con
    DNI/NIE/Pasaporte <b>{{$client->document_nr}}</b> , que actúa como parte arrendataria.</p>
<p>Ambas partes, en su propio nombre y derecho, con capacidad legal y legitimidad necesarias para obligarse en presente
    contrato de arrendamiento, manifiestan lo siguiente:</p>
<h3>CLÁUSULAS</h3>
<p><b>PRIMERA</b> - La estancia se llevará a cabo en la vivienda de uso turístico <b>{{$apartment->name}}</b> situada en
    Calle <b>{{$apartment->location}}</b>, Madrid, España, y está amueblada, equipada y en condiciones de uso inmediato.
</p>
<p><b>SEGUNDA</b> - El periodo de la estancia de la vivienda arrendada comienza el
    <b>{{\Carbon\Carbon::parse($reservation->check_in)->format('m-d-Y')}}</b> y finaliza el
    <b>{{\Carbon\Carbon::parse($reservation->check_out)->format('m-d-Y')}}</b>. y para <b>{{$client->name}}</b>
    personas. El usuario se compromete a no sobrepasar éste número de
    personas sin autorización expresa del titular. El disfrute de la estancia dura el plazo convenido entre el titular y
    el usuario. Cualquier ampliación o reducción del plazo previamente pactado, está sujeto al mutuo acuerdo entre
    titular y usuario.</p>
@php
    $total_price=\App\ReservationPriceList::totalReservationPrice($reservation->id);
@endphp
<p><b>TERCERA</b> - El precio acordado de la estancia por ambas partes para el período estipulado en la cláusula segunda
    del presente contrato aumenta a <b>{{$total_price}} €</b>. El precio incluye: los suministros de agua, energía
    electrica, gas,
    climatización, uso de ropa de cama y baño,
    y limpieza inicial de la vivienda. Dicho importe se abona de la forma siguiente:</p>
<ul>
    <li>…,..€ received as deposit through bank transfer or credit card payment.</li>
    <li>…,..€ which are paid when signing the contract.</li>
</ul>
<p><b>CUARTA</b> - El usuario declara recibir el inmueble en perfecto estado de uso y se compromete, al término del
    contrato, a mantener y entregar en idénticas condiciones en que recibe la vivienda. Hacer un uso conveniente y
    razonable del mobiliario y de los equipos, durante el periodo de la estancia estipulada por ambas partes, siendo por
    cuenta del usuario la
    reposición y reparación de cuantas pérdidas y deterioros le sean imputables. Avisar al titular, en caso de avería,
    desperfecto o accidente que pudiera producirse en la vivienda durante su estancia. Para responder a la obligación de
    reemplazar y reparar las pérdidas y deterioros mencionados en el párrafo anterior, el usuario debe facilitar un
    número de tarjeta de crédito válida.</p>
<p><b>QUINTA</b> - rohibiciones y obligaciones del usuario:</p>
<ol>
    <li>Está prohibido realizar ﬁestas y cualquier tipo de actividad que cause ruido o molestias a los vecinos .</li>
    <li>Está prohibido introducir animales en la vivienda, salvo expresa autorización por escrito del titular.</li>
    <li>Está prohibido ensuciar los espacios comunes del ediﬁcio.</li>
    <li>No está permitido fumar dentro de la vivienda; únicamente se permite en la terraza o balcón si lo hubiera.</li>
    <li>En caso de detectar durante la salida que el cliente ha fumado se aplicaría una multa de 70€.</li>
    <li>Es obligatorio respetar todas las normas internas del inmueble, que forma parte de una comunidad o residencia.
    </li>
</ol>
<p><b>SEXTA</b> - El usuario se hace directa y exclusivamente responsable y exime de toda responsabilidad al titular por
    los daños que puedan ocasionarse a personas o cosas y sean consecuencia de negligencia o el mal uso de las
    instalaciones para servicios y suministros de la vivienda de uso turístico.</p>

<p><b>SEPTIMA</b> - El presente contrato quedará automáticamente resuelto sin necesidad de previo aviso, en la fecha
    indicada
    en la segunda cláusula, como ﬁn del período de la estancia, debiendo la parte arrendataria entregar las llaves al
    titular. Sin perjuicio de lo anterior, el titular conserva la posesión de un juego de llaves, y está expresamente
    autorizado por la ﬁrma del presente contrato a utilizarlas llegado ese momento, para entrar, retirar las
    pertenencias del usuario y disponer de la vivienda. El mismo derecho tiene el titular en los supuestos en que la
    factura no sea abonada o que la persona haya sido desalojada por cualquier motivo de incumplimiento de las
    obligaciones previstas en el presente contrato, en particular de las prohibiciones y obligaciones previstas en la
    cláusula quinta anterior.</p>
<p><b>OCTAVA</b> - El presente contrato se rige por lo dispuesto en el Decreto 79/2014, de 10 de julio, que regula los
    apartamentos turísticos y las viviendas de uso turístico de la Comunidad de Madrid. Con renuncia expresa al fuero
    propio que pudiera corresponderles, las partes ﬁrmantes se someten al arbitraje de equidad de la Cámara de Comercio
    e Industria de Madrid. Comprometiéndose ambas partes en este acto a aceptar el laudo que en su día se dicte.</p>
<p>Ambas partes se ratiﬁcan en el presente contrato y ﬁrman por duplicado, a un solo efecto, en el lugar y fecha
    indicados en el encabezamiento.</p>
<p>CONDICIONES:</p>
<p>ENTRADA</p>
<p>A la hora previamente coordinada, un miembro de nuestro personal le estará esperando en la vivienda para
    proporcionarle llaves de la misma y el contrato de alquiler de temporada, una de cuyas copias deberá ser firmada por
    usted. También le explicará el funcionamiento de los electrodomésticos existentes.
    <br><br>
    La entrada en la vivienda se realizará a partir de las 15 horas. La entrada a partir de las 22 horas conlleva un
    suplemento de 30€ abonados en efectivo a su llegada.</p>
<p>Durante toda la estancia en la vivienda, dispondrá de un teléfono de ayuda que le atenderá en cualquier
    diﬁcultad. </p>
<p>TLF: +34 640 03 11 82</p>
<p>ESTANCIA</p>
<p>Durante toda la estancia en la vivienda, dispondrá de un teléfono de ayuda que le atenderá en cualquier diﬁcultad. </p>
<p>TLF: +34 640 03 11 82</p>
<p>SALIDA</p>
<p>A la hora prevista de salida, el personal del representante del titular se desplazará a la vivienda para recoger las
    llaves de la misma. La salida, salvo especiﬁcación en contrario, se realizará antes de las 11 de la mañana. Al
    finalizar la estancia el cliente está obligado a dejar la vivienda de uso turístico en un estado razonable: sacar la
    basura la noche anterior y dejar la cocina sin restos orgánicos. En caso contrario se le cargará el coste
    correspondiente a una limpieza extra.</p>
<p>CANCELACIÓN</p>
<p>Si el huésped decida dejar la vivienda antes del día previsto para la salida, no se devolverá ningún tipo de
    importe.</p>
<p>INCLUIDOS</p>
<p>Éstas son las condiciones relativas a los extras incluidos en el apartamento:</p>
<p>El inquilino conectará sus dispositivos al Wiﬁ disponible en la vivienda mediante usuario y contraseña.
    Madreams Rent no se hace responsable en ningún caso de los posibles problemas derivados de la incompatibilidad entre
    el sistema operativo o la tarjeta Wiﬁ, con la red Wiﬁ instalada en el piso, cortes de suministro por parte del
    operador de telefónica o caídas de la red Wiﬁ por cualquier motivo.
    <br><br>
    Madreams Rent no se responsabiliza por ningúna avería que surja del edificio, en relación con el agua, energía
    eléctrica o el gas.
    <br><br>
    Madreams Rent no dispone de servicio técnico para la solución de incidencias. No obstante, intentaremos ayudarle a
    resolver los problemas que puedan surgirle.</p>
<p>Hora de salida: <b>{{\Carbon\Carbon::parse($reservation->check_out)->format('h:m')}}</b></p>
<p>Teléfono de contacto: +<b>{{$reservation->phone}}</b>.</p>
<p>Depósito:</p>
<hr>
<p>TARJETA: <span style="margin-left: 500px;">FECHA CADUCIDAD:</span></p>
<p>TITULAR: <span style="margin-left: 500px;">FIRMA:</span></p>
<p>El usuario <span style="float: right; margin-right: 60px;">La Agencia</span></p>
<img src="{{base_path().'/public/images/madrent_logo.jpg'}}" style="margin-left: 100px; width: 150px; height: auto">
<h2 style="text-align: center"><b><u> NORMAS DE SEGURIDAD </u></b></h2>
<p>Durante su estancia, se ruega vigilar las siguientes pautas :</p>
<ol>
    <li><h3><b><u>Siempre que se salga del piso:</u></b></h3>
        <ol type="a">
            <li><b>Apagar todos los electrodomésticos, luces y aire acondicionado.</b>
                Usted será responsable en caso de que se produzca algún daño en el apartamento en su ausencia.
            </li>
            <li>Cerrar las ventanas, persianas y contraventanas.</li>
            <li><b>Cerrar la puerta principal con llave antes de asegurarse que no hay ninguna llave en la
                    cerradura.</b></li>
            <li><b>Tenga en cuenta que, si olvida la llave dentro de la cerradura, tendremos que llamar a un cerrajero y
                    usted será responsable de cualquier cargo.</b></li>
        </ol>
    </li>
    <li><h3><b><u>Check-Out:</u></b></h3>
        <ol type="a">
            <li>No es necesario que espere en el apartamento, deje la llave en la mesa y cierre la puerta detrás de
                usted.
            </li>
            <li>Como proporcionó su tarjeta de crédito como depósito en caso de cualquier daño, no hay nada que devolver
                porque no se cobró ninguna cantidad.
            </li>
        </ol>
    </li>
    <li>
        <h3><b><u>Mientras está en el piso:</u></b></h3>
        <ol type="a">
            <li>Tener sumo cuidado con los electrodomésticos que utilicen fuego para su funcionamiento, cocina, caldera…
                En caso de tener algún problema, llamar al teléfono de atención 24h que figura en el contrato. En caso
                de emergencia también puede llamar al número <b>112.</b></li>
            <li>En caso de que haya menores de edad a su cargo, deberá supervisar el comportamiento de los menores.</li>
            <li><b>Tirar la basura a partir de las 20hrs en el cubo que está fuera del portal.</b></li>
        </ol>
    </li>
    <li>
        <h3><b><u>Está terminantemente prohibido:</u></b></h3>
        <ol type="a">
            <li>Prohibido fumar, salvo en la terraza o balcón si lo hubiera.</li>
            <li>Los huéspedes que se alojen en nuestros apartamentos deben saber que si las fiestas o la música a todo
                volumen molestan a los vecinos o/y se llama a la policía, podría producirse un desalojo inmediato
                independientemente de la hora. Ésto también resultará en la pérdida de la renta prepaga.
            </li>
            <li>  También tenga en cuenta que al reservar con nosotros ya ha aceptado nuestros términos y condiciones,
                y por lo tanto, se espera que cumpla con éstas reglas.
                <b>EL HORARIO EN QUE DEBE RESPETAR ÉSTAS NORMAS ES DE 22.00 A 10.00.</b>
                Agradecemos su colaboración en éste asunto y esperamos que entienda que éstas reglas son necesarias, ya
                que éstos apartamentos están ubicados en edificios residenciales y el resto nocturno de otros habitantes
                debe ser respetado.
            </li>
        </ol>
    </li>

</ol>
<p><b>NOMBRE Y APELLIDO:{{$client->name}}</b></p>
<p><b>FIRMA:</b></p>
<img src="{{base_path().'/storage/app/public/signatures/'.$reservation->signature}}" style="margin-left: 10px; width: 150px; height: auto">

</body>
</html>