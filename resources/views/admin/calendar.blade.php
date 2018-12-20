

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>

    <!-- Dashboard 1 Page CSS -->
    <link href="{{asset('dist/css/pages/dashboard1.css')}}" rel="stylesheet">
    <link href="{{asset('css_login/pages/login-register-lock.css')}}" rel="stylesheet">
    <link href="{{asset('css_login/style.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/custom_style.css')}}">
    <title>FullCalendar!</title>
</head>
<style>
    .fc-agendaDay-button{
        display: none !important;
    }
    .fc-today-button{
        display: none !important;
    }

    h2{
        font-family: 'Share Tech Mono', monospace;
        text-decoration: underline;
        font-size: 38px;
    }
</style>
<body>
@include('admin.parts.nav_bar')

<div class="jumbotron calendar_parallax">
    <div class="calendar_titles">
    <h1 class="calendar_main_title">Full Calendar of reservations</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default mb-5">
                <a href="/admin/dashboard" class="btn btn-success">Back to DashBoard &nbsp;<i class="far fa-hand-point-left"></i></a>
                @include('admin.parts.messages.success')
                @include('admin.parts.messages.error')
                @include('admin.parts.messages.custom_error')
                <div class="panel-heading calendar_second_title"><u> Reservations Calendar & The Customers</u> &nbsp;<i class="fas fa-calendar-check"></i></div>
               <p class="attention_calendar">Click on reservation to see all details</p>
                <div class="panel-body">

                    {!! $calendar->calendar() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@php
$reservations=\App\Reservation::all()
@endphp

@foreach($reservations as $reservation)
    @include('admin.parts.modals.view.reservation')
@endforeach

<script>
            @php
                $apartments=\App\Apartment::all()
            @endphp



    var ddData=[
                    @foreach($apartments as $apartment)
                    @php
                        $apartment_photo=\App\Picture::where('apartments_id', $apartment->id)->first();

                    @endphp
            {

                text: "{{$apartment->location}}",
                value:{{$apartment->id}},
                selected: false,
                description: "{{str_limit($apartment->description,200,'...')}}",
                    @if($apartment_photo)
                    imageSrc: "{{asset("storage/apartments_photos/$apartment_photo->filename")}}"
                    @endif
            },


                @endforeach
        ];

    $('#slick_apartments').ddslick({
        data: ddData,
        width: 300,
        imagePosition: "right",
        selectText: "Select Apartment for client",
        onSelected: function (data) {

        }
    });

</script>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>

<script src="{{asset('js/ddslick.js')}}"></script>
@include('admin.parts.modals.add.reservation')
@php

    $client=\App\Person::where('id',$reservation->persons_id)->first();
@endphp
@foreach($reservations as $reservation)
    @include('admin.parts.modals.edit.reservation')
@endforeach
{!! $calendar->script() !!}



</body>
</html>
