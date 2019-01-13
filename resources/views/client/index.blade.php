@extends('client.layouts.master')
@section('content')
    <div class="search_area">
        <div class="go_bot_div">
            <p class="sem">Vezi mai multe despre MadreamsRent</p>
            <i class="fas fa-angle-double-down downarr"></i>
        </div>
        <div class="container">
            <p class="title_hm">Cauta apartamentul potrivit pentru nevoile tale cu <span style="font-weight: 900">MadreamsRent</span>
            </p>
            <div class="search_support">
                <div class="actual_search">
                    <div class="div_inp_left">
                        <img src="{{asset('images/site_images/city-solid.png')}}" class="img_city">
                        <input type="text" class="input_srr" placeholder="Oras..." value="Madrid" disabled>
                    </div>
                    <div class="div_inp">
                        <i class="far fa-calendar-alt inp_icon"></i>
                        <input type="text" class="input_srr" placeholder="Data check-in">
                    </div>
                    <div class="div_inp">
                        <i class="far fa-calendar-alt inp_icon"></i>
                        <input type="text" class="input_srr" placeholder="Data check-out">
                    </div>
                    <div class="div_inp">
                        <i class="fas fa-users inp_icon"></i>
                        <input type="text" class="input_srr" placeholder="Nr. persoane">
                    </div>
                    <a href="afisare_rezultate.html">
                        <div class="div_inp_right">
                            <button type="button" class="button_sr">Cauta acum</button>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="content">
            <div class="oferte_si_beneficii">
                <p class="big_title">OFERTE SI BENEFICII</p>
                <p class="sub_big_title">Lorem ipsum dolor sit amen, consecteur adipiscing elit.</p>
                <div class="benefit_div">
                    <div class="row">
                        <div class="col-md-8" style="overflow-y: auto; height: 450px;">
                            @php
                            $limit=1
                            @endphp
                            @foreach($offers as $offer)
                                @if($limit===6)
                                    @break
                                @endif
                            <div class="element_oferta mt-2" data-toggle="modal" data-target="#modalOffer{{$offer->id}}">
                                <div class="row">
                                    <div class="col-md-2 col-xs-2 mb-2">
                                        <div class="promotion_tag">
                                            <p class="text_prom_tag">{{$offer->discount }} {!! $offer->discount!='free' ? "% <br> off" : ''!!}</p>
                                        </div>
                                    </div>
                                    <div class="col-md-10 col-xs-10">
                                        <div><p class="title_prom"><i class="fas fa-asterisk icon_title"></i>&nbsp;&nbsp;{{$offer->name}}</p>
                                        <p class="desc_prom">
                                            {{str_limit($offer->description,100,'...')}}
                                        </p>
                                        </div>
                                        <a href="{{$offer->restaurant_url}}" style="display: block"><p class="link_to_rs">Link to Site</p></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>
                        <div class="col-md-4">
                            <img src="{{asset('images/site_images/abg.png')}}" class="img_bnf">
                        </div>
                    </div>
                </div>
            </div>
            <div class="phone_area">
                <p class="big_title">Aplicatia MadreamsRent este disponibila pe:</p>
                <div class="inliner">
                    <img src="{{asset('images/site_images/appstore.pn')}}g" class="img_phone">
                    <img src="{{asset('images/site_images/android.png')}}" class="img_phone">
                </div>
                <p class="sub_big_title">Descarca acum aplicatia pe dispozitivul tau!</p>
            </div>
            <hr class="hr_blue">
            <div class="blog_area">
                <p class="big_title lf">Postari din blogul Madreams</p>
                <div class="row">
                        @php
                            $i=1;
                        @endphp

                        @foreach($blogs as $blog)
                            @if($i===5)
                                @break
                            @endif
                            <div class="col-md-6">
                                <a href="/clients/blog/{{$blog->id}}">
                                <div class="blog_post">
                                    <img src="{{asset("storage/pages_image/$blog->image")}}" class="img_blog">
                                    <div class="right_part_blg">
                                        <p class="date_bl">{{\Carbon\Carbon::parse($blog->created_at)->format('d-m-Y')}}</p>
                                        <p class="blog_title">{{$blog->name}}</p>
                                        <p class="blog_text">
                                            {{str_limit($blog->content, 1000, '...')}}
                                        </p>
                                        <p class="all_blog">Citeste tot articolul...</p>
                                    </div>
                                </div>
                    </a>
                </div>
                @php
                    $i++
                @endphp
                @endforeach


            </div>
            </div>
                <div class="row offset-4">
                    <a href="/clients/blog"><p class="link_to">Du-ma la blog pentru a vedea toate articolele</p></a>
                </div>
        </div>
    </div>
    </div>
        @foreach($offers as $offer)
            @include('client.layouts.modals.view.offer')
        @endforeach
@endsection