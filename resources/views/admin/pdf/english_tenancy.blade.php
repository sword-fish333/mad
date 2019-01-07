<html>

<body style="margin-left: 20px;">
<img src="{{base_path().'/public/images/madrent_logo.jpg'}}" style="margin-left: 100px; width: 150px; height: auto">
<hr>
<h2>Temporary tenancy agreement for tourist apartments</h2>
<h4 style="float: right; margin-right: 30px">In Madrid, of {{\Carbon\Carbon::now()->format('M-d-Y')}}</h4>
<h4>The parties involved:</h4>
<p style="margin-top: 30px">&nbsp;&nbsp;From one part, Mr Andrei Campeanu (who will here with be known as holder), of
    legal age, ID/ Passport number Y1695604N, that acts on behalf and representation of the Madreams Rent trade in
    Madrid and provided by N.I.F. Y1695604N, and acts as leaser and representative of the owner of the apartment
    situated in Street <b>{{$apartment->location}} </b>,  Madrid, Spain.</p>
<p>On the other part, Mr/Mrs  <b>{{$client->name}}</b>. (who will here with be known as the guest), of legal age, with ID/
    Passport number &nbsp; <b>{{$client->document_nr}}</b> , that acts as a tenant.</p>
<p>Both parties, in their own name and right, recognizing the full legal capacity of the granting of this lease
    agreement, and respect it.</p>
<h3>CLAUSES</h3>
<p><b>FIRST</b> - The tenancy will be carried out in the apartment <b>{{$apartment->name}}</b> situated in Street
    <b>{{$apartment->location}}</b>Madrid,Spain , which is furnished, equipped and in state of immediate use.
</p>
<p><b>SECOND</b> -The rental period of the apartment in question, starts on
    <b>{{\Carbon\Carbon::parse($reservation->check_in)->format('m-d-Y')}}</b>&nbsp; and ends the
    <b>{{\Carbon\Carbon::parse($reservation->check_out)->format('m-d-Y')}}</b> &nbsp;for <b>{{$client->name}}. </b>
     The enjoyment of the accommodation lasts the period agreed between the holder and the guest. Any extension
    or reduction of the previously agreed period is subject to mutual agreement between the holder and the guest.</p>
@php
    $total_price=\App\ReservationPriceList::totalReservationPrice($reservation->id);
@endphp
<p><b>THIRD</b> -The rental price agreed by both parties for the period stipulated in clause two of this contract
    amounts to <b>{{$total_price}} €</b>. The price includes: water supply, electric power, gas, air conditioning, use of
    bed and bath linen and initial cleaning of the apartment. This amount is paid as follows:</p>
<ul>
    <li>…,..€ received as deposit through bank transfer or credit card payment.</li>
    <li>…,..€ which are paid when signing the contract.</li>
</ul>
<p><b>FORTH</b> - The guest agrees, at the end of the contract, to maintain the apartment and return it in the same
    state which he/she received it. Make convenient and reasonable use of furniture and equipment, during the rental
    period stipulated by both parties. It is the tenant’ responsability to replace or repair of any losses and damages
    which are incurred to the apartment during the tenancy period. In order to respond to the obligation to replace and
    repair the losses and deterioration referred to previously, the guest must provide a valid credit card number.</p>
<p><b>FIFTH</b> - Guest's bans and obligations:</p>
<ol>
    <li>It is forbidden to organize parties or any kind of activity that generates noises or inconvenience to neighbors
        .
    </li>
    <li>t is forbidden to bring animals into the apartment, unless expressly authorized in writing by the owner.</li>
    <li>It is forbidden to litter the common spaces of the building.</li>
    <li>Smoking is not allowed inside the apartment, it can only be done on the terrace or balcony if there is one.</li>
    <li>In case of detecting during the departure that the client has smoked inside the apartment, a fine of 70€ would
        be applied.
    </li>
    <li>It is mandatory to comply with all the rules of the community of owners to which the apartment belongs.
    </li>
</ol>
<p><b>SIXTH</b> -The guest is directly and excusively responsible and relieves the holder from any liability for damages
    that may be caused to persons or things and which are the results of negligence or misuse of facilities for services
    and goods of the apartment.</p>

<p><b>SEVEN</b> - This contract will be automatically terminated without prior notice, at the date indicated in the
    second clause, as the end of the accommodation period, and the tenant must give the keys to the holder. Without
    prejudice to the foregoing, the holder retains a set of keys and is expressly authorized by signing this contract,
    to use them at that time, to enter, remove the tenant´s belongings and vacate the apartment. The same entitlement
    lies with the holder in cases where the invoice has not been paid or the person has been evicted for any reason for
    breaching the obligations set fourth in this contract, in particular the prohibitions and obligations arising from
    the previous clause.</p>
<p><b>EIGHT</b> - This contract is governed by the provisions of Decree 79/2014, of July 10, which regulates tourist
    apartments and housing of tourist use of the Community of Madrid. By expressly waiving the appropriate jurisdiction,
    witch corresponds to them, the signatory parties shall submit to the arbitration of the Chamber of Commerce and
    Industry or Madrid. Compromising both parties in this act to accept the award that was issued at the time.</p>
<p>Both parties ratify this contract and sign in duplicate, for one purpose, at the place and date indicated in the
    heading.
</p>
<p><b>TERMS:</b></p>
<p><b>CHECK-IN</b></p>
<p>At the prearranged time, a member of our staff will be waiting for you at the apartment to hand over the keys, and
    the rental contract of the season, which you will have sign it. They will also explain how to operate the appliances
    in the apartment.
    <br><br>
    Entry to the apartment will be made after 3pm. Late check-ins (from 10pm) will incur an extra charge of 30€, paid
    cash upon arrival.</p>
<p><b>STAY</b></p>
<p>During the entire stay in the apartment you will have a phone number that you can call in case of any
    difficulty. </p>
<p>TLF: +34 640 03 11 82</p>
<p><b>CHECK-OUT</b></p>

<p>At the prearranged departure time, a member of our staff will come to the apartment in order to collect the keys. The
    departure, unless otherwise specified, will be made before 11am. At the end of the stay the guest is obliged to
    leave the apartment in a reasonable conditions: take out the garbage the night before and leave the kitchen without
    any organic remains. Otherwise, the cost corresponding to an extra cleaning will be charged.</p>
<p><b>CANCELLATION</b></p>
<p>If the guest decides to leave the apartment before the scheduled day of departure, no amount will be refunded.</p>
<p><b>HOLDER RIGHTS</b></p>
<p>These are the relative services included with the apartment:</p>
<p>The guest will connect his devices to the Wi-Fi available in the apartment through username and password.
    <br><br>
    MMadreams Rent is not responsible of any issues arising from the incompatibility between the operating system or the
    Wi-Fi card, with the network being installed in the apartment, telephone interruptions by the mobile operator or
    network interruptions Wi-Fi for any reason.
    <br><br>
    Madreams Rent is not responsible for any damage caused by the building, in relation with water, electricity or gas.
    <br><br>
</p>
<p>Check-out hour: <b>{{\Carbon\Carbon::parse($reservation->check_out)->format('h:m')}}</b></p>
<p>Telephone number of tenant: +<b>{{$reservation->phone}}</b>.</p>
<p>Deposit guarantee:</p>
<hr>
<p>CARD No: <span style="margin-left: 500px;">EXPIRATION DATE:</span></p>
<p>HOLDER: <span style="margin-left: 500px;">FIRMA:</span></p>
<p>The tenant <span style="float: right; margin-right: 60px;">The Agency</span></p>
<img src="{{base_path().'/public/images/madrent_logo.jpg'}}" style="margin-left: 40px; width: 150px; height: auto">
<h2 style="text-align: center"><b><u> SAFETY MEASURES </u></b></h2>
<p>During your stay, please be so kind as to comply with the following guidelines :</p>
<ol>
    <li><h3><b><u>Whenever you leave the apartment:</u></b></h3>
        <ol type="a">
            <li><b>Turn off all the appliances, light and air-conditioning.</b>
                You will be responsible for any damage at the apartment.
            </li>
            <li>Close all the windows and pull down all the blinds and shutters.</li>
            <li><b>Lock the main door, take the key with you and do not leave any key in the lock/door.</b></li>
            <li><b>Keep in mind, if you forget the key inside, we will have to call a locksmith and you will be
                    responsable of any charge. </b></li>
        </ol>
    </li>
    <li><h3><b><u>Check-Out:</u></b></h3>
        <ol type="a">
            <li>It is not necessary for you to wait at the apartment, <b> please leave the key on the table</b> and
                close the door behind you.
            </li>
            <li>Since you provided your credit card as a deposit in case of any damage, there is nothing to refond
                because we didn’t charge any amount.
            </li>
        </ol>
    </li>
    <li>
        <h3><b><u>While in the apartment:</u></b></h3>
        <ol type="a">
            <li>Be especially careful with all the fuel-burning appliances, such as cookers, heaters and the like.
                Should you have any problems, call the 24 hours emergency service which is stated in the contract. Also
                you can call the <b> 112</b> in case of any emergency.
            </li>
            <li>Should you have any children in your care, you have to take responsibility for their behaviour.</li>
            <li><b>Please throw out the trash from 8:00 pm onwards. You will find the bin outside, in front of the
                    building main door.</b></li>
        </ol>
    </li>
    <li>
        <h3><b><u>Strictly forbidden:</u></b></h3>
        <ol type="a">
            <li>Smoking is not allowed in the apartment, it can only be done on the terrace or balcony if there is
                one.
            </li>
            <li>Guests staying in our apartments should know that if parties or loud music are disturbing the
                neighbours, if police are called, it could result in immediate eviction regardless of the time. This
                will also result in loss of prepaid rent.
            </li>
            <li> c) Also note that by booking with us you have already accepted our terms and conditions and will
                therefore be expected to abide by these rules.
                <b> QUIET TIME IS EVERY DAY FROM 10.00 pm to 10.00 am.</b>
                We appreciate your collaboration in this matter and hope you understand that these rules are necessary
                as these apartments are all situated in residential buildings and the nightly rest of other inhabitants
                must be respected.
            </li>
        </ol>
    </li>

</ol>
<p><b>NAME AND LAST NAME:&nbsp;{{$client->name}}</b></p>
<p><b>SIGNATURE:</b></p>
<img src="{{base_path().'/storage/app/public/signatures/'.$reservation->signature}}" style="margin-left: 10px; width: 150px; height: auto">
</body>
</html>