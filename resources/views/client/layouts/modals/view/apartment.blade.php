<div class="modal fade" id="modalApartment{{$apartment->id}}" role="dialog">
    <div class="modal-dialog el_modal_sec">
        <div class="modal-content el_modal_sec">
            <div class="modal-header mdh2">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            @php
                $ap_photos=\App\Picture::where('apartments_id', $apartment->id)->get();

            @endphp
            <div class="modal-body mdb2">

                <div id="modalCarousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">

                        <li data-target="#modalCarousel" data-slide-to="0" class="active"></li>
                        @for($i=1; $i<=count($ap_photos);$i++)
                            <li data-target="#modalCarousel" data-slide-to="{{$i}}"></li>
                        @endfor
                    </ol>
                    <div class="carousel-inner">

                        @foreach($ap_photos as $ap_photo)
                            <div class="item">
                                <img src="{{asset("storage/apartments_photos/$ap_photo->filename")}}"
                                     class="img_modal_fr">
                            </div>
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#modalCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#modalCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
                <div class="cont_mod">
                    <p class="title_el_ct">Nume apartament lorem ipsum dolor sit amen consectetur adipiscing elit.</p>
                    <div class="beneft">
                        <p class="loc_ttt"><i class="fas fa-fire el_ic"></i> Lorem ipsum dolor sit amen, consecteur
                            adipiscing elit.</p>
                        <p class="loc_ttt"><i class="fas fa-shield-alt el_ic"></i> Lorem ipsum dolor sit amen,
                            consecteur adipiscing elit.</p>
                        <p class="loc_ttt"><i class="fas fa-map-marker-alt el_ic"></i> Lorem ipsum dolor sit amen,
                            consecteur adipiscing elit.</p>
                        <p class="loc_ttt"><i class="fas fa-bed el_ic"></i> Lorem ipsum dolor sit amen, consecteur
                            adipiscing elit.</p>
                        <p class="loc_ttt"><i class="fas fa-leaf el_ic"></i> Lorem ipsum dolor sit amen, consecteur
                            adipiscing elit.</p>
                    </div>
                    <hr class="hr_header2">
                    <p class="titl_mc">Informatii de contact:</p>
                    <p class="loc_ttt"><i class="far fa-compass el_ic"></i> Lorem ipsum dolor sit amen, consecteur
                        adipiscing elit.</p>
                    <p class="loc_ttt"><i class="fas fa-phone el_ic"></i> Lorem ipsum dolor sit amen, consecteur
                        adipiscing elit.</p>
                    <p class="loc_ttt"><i class="fas fa-at el_ic"></i> Lorem ipsum dolor sit amen, consecteur adipiscing
                        elit.</p>
                    <div style="text-align: center">
                        <a href="pagina_apartament.html"><p class="big_button">Vezi ofertele <i
                                        class="fas fa-angle-right"></i></p></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>