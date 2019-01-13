@extends('client.layouts.master')
@section('content')
    <div class="header_title_blue">
        <div class="inner_titl">
            <p class="text_title">Available Apartments in Madrid  in <b>  {{$check_in}}</b> and <b>{{$check_out}}</b> for <b>{{$nr_persons}}</b> persons</p>
        </div>
    </div>

    <div class="content_w_title">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <p class="date_bl">{{count($apartments).'  results'}}</p>
                    <hr class="hr_header">
                    @foreach($apartments as $apartment)
                        @php
                            $apartment_photo=\App\Picture::where('apartments_id', $apartment->id)->first();
                        @endphp
                    <div class="element_cautare" data-toggle="modal" data-target="#modalApartment{{$apartment->id}}">
                        @if($apartment_photo)
                        <img src="{{asset("storage/apartments_photos/$apartment_photo->filename")}}" class="img_element_ct">
                       @else

                            <img src="" alt="Apartment Image" class="img_element_ct">

                        @endif
                        <div class="content_el_ct">
                                @if($apartment->name)
                                <p class="title_el_ct">{{$apartment->name}}</p>
                            @else
                                <p class="title_el_ct">No name Available</p>
                                    @endif
                            <p class="loc_tt"><i class="far fa-compass el_ic"></i> {{$apartment->location}}</p>
                            <p class="loc_tt">
                               {{str_limit($apartment->description, 250, '....')}}
                            </p>
                        </div>
                    </div>
                    @endforeach


                    <div class="paginare">
                        <div class="suport_paginare"><i class="fas fa-angle-left ic_pag"></i></div>
                        <div class="suport_paginare"><p class="text_pag">1</p></div>
                        <div class="suport_paginare"><p class="text_pag">2</p></div>
                        <div class="suport_paginare"><p class="text_pag">3</p></div>
                        <div class="suport_paginare"><p class="text_pag">4</p></div>
                        <div class="suport_paginare"><i class="fas fa-angle-right ic_pag"></i></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="sr_rght">
                        <p class="titl_sr_rg">Fa o cautare noua</p>
                        <hr class="hr_white">
                        <form action="/clients/search" method="post">
                            @csrf
                        <div class="input_suport">
                            <i class="far fa-calendar-alt inp_icon"></i>

                            <input type="text" class="input_sr datepicker" autocomplete="off" name="check_in" placeholder="Data check-in">
                        </div>
                        <div class="input_suport">
                            <i class="far fa-calendar-alt inp_icon"></i>
                            <input type="text" class="input_sr datepicker" autocomplete="off" name="check_out" placeholder="Data check-out">
                        </div>
                        <div class="input_suport">
                            <i class="fas fa-users inp_icon"></i>
                            <input type="text" class="input_sr" name="persons_nr" placeholder="Nr. persoane">
                        </div>
                        <button type="submit" class="but_sr_rg">Search Now</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @foreach($apartments as $apartment)
        @include('client.layouts.modals.view.apartment')
    @endforeach
    <script>
        $( function() {
            $( ".datepicker" ).datepicker({
                minDate: 0,

            });
        } );
    </script>
    @endsection