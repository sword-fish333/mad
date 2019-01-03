<html>
<body>

<h1>Contrato de prestación de alojamiento en vivienda de uso turístico</h1>
<h4 style="float: right; margin-right: 30px">En Madrid, a ………………….</h4>
<h5>LAS PARTES INVOLUCRADAS</h5>
<p style="margin-top: 30px">&nbsp;&nbsp;De una parte, Madreams Rent
    (quién estará aquí siendo conocido como titular), con sede en Madrid,
    y representada por D. Andrei Campeanu, mayor de edad, y provista de N.I.F.
    Y1695604 N, que actúa como parte arrendadora y representante del titular de

    la vivienda de uso turístico sita en Calle <span><b>{{$apartment->location}}</b></span>,  Madrid,  España.</p>
<p>De otra parte, D/Dª <b>{{$client->name}}</b>.(quién estará aquí siendo conocido como usuario) mayor de edad, con DNI/NIE/Pasaporte <b>{{$client->document_nr}}</b> , que actúa como parte arrendataria.</p>
<p>Ambas partes, en su propio nombre y derecho, con capacidad legal y legitimidad necesarias para obligarse en presente contrato de arrendamiento, manifiestan lo siguiente:</p>
<h3>CLÁUSULAS</h3>
<p><b>PRIMERA</b> - La estancia se llevará a cabo en la vivienda de uso turístico <b>{{$apartment->name}}</b> situada en Calle <b>{{$apartment->location}}</b>, Madrid, España, y está amueblada, equipada y en condiciones de uso inmediato.</p>
<p><b>SEGUNDA</b> - El periodo de la estancia de la vivienda arrendada comienza el <b>{{\Carbon\Carbon::parse($reservation->check_in)->format('m-d-Y')}}</b> y finaliza el  <b>{{\Carbon\Carbon::parse($reservation->check_out)->format('m-d-Y')}}</b>. y para <b>{{$client->name}}</b> personas. El usuario se compromete a no sobrepasar éste número de
    personas sin autorización expresa del titular. El disfrute de la estancia dura el plazo convenido entre el titular y el usuario. Cualquier ampliación o reducción del plazo previamente pactado, está sujeto al mutuo acuerdo entre titular y usuario.</p>
<p><b>TERCERA</b> - El precio acordado de la estancia por ambas partes para el período estipulado en la cláusula segunda del presente contrato aumenta a …..,..€. El precio incluye: los suministros de agua, energía electrica, gas, climatización, uso de ropa de cama y baño,
    y limpieza inicial de la vivienda. Dicho importe se abona de la forma siguiente:</p>
<ul>
    <li>…,..€  received as deposit through bank transfer or credit card payment.</li>
    <li>…,..€  which are paid when signing the contract.</li>
</ul>
<p><b>CUARTA</b> - El usuario declara recibir el inmueble en perfecto estado de uso y se compromete, al término del contrato, a mantener y entregar en idénticas condiciones en que recibe la vivienda. Hacer un uso conveniente y razonable del mobiliario y de los equipos, durante el periodo de la estancia estipulada por ambas partes, siendo por cuenta del usuario la
    reposición y reparación de cuantas pérdidas y deterioros le sean imputables. Avisar al titular, en caso de avería, desperfecto o accidente que pudiera producirse en la vivienda durante su estancia. Para responder a la obligación de reemplazar y reparar las pérdidas y deterioros mencionados en el párrafo anterior, el usuario debe facilitar un número de tarjeta de crédito válida.</p>
<p><b>QUINTA</b> - rohibiciones y obligaciones del usuario:</p>
<ol>
    <li>Está prohibido realizar ﬁestas y cualquier tipo de actividad que cause ruido o molestias a los vecinos .</li>
<li>Está prohibido introducir animales en la vivienda, salvo expresa autorización por escrito del  titular.</li>
<li>Está prohibido ensuciar los espacios comunes del ediﬁcio.</li>
<li>No está permitido fumar dentro de la vivienda; únicamente se permite en la terraza o balcón si lo hubiera.</li>
<li>En caso de detectar durante la salida que el cliente ha fumado se aplicaría una multa de 70€.</li>
<li>Es obligatorio respetar todas las normas internas del inmueble, que forma parte de una comunidad o residencia.</li>
</ol>
<p><b>SEXTA</b> - El usuario se hace directa y exclusivamente responsable y exime de toda responsabilidad al titular por los daños que puedan ocasionarse a personas o cosas y sean consecuencia de negligencia o el mal uso de las instalaciones para servicios y suministros de la vivienda de uso turístico.</p>
</body>
</html>