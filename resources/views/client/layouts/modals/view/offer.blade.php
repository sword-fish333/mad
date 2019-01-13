<div class="modal fade" id="modalOffer{{$offer->id}}" role="dialog">
    <div class="modal-dialog el_modal">
        <div class="modal-content el_modal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2 col-xs-2">
                        <div class="promotion_tag">
                            <p class="text_prom_tag">{{$offer->discount }} {!! $offer->discount!='free' ? "% <br> off" : ''!!}</p>
                        </div>
                    </div>
                    <div class="col-md-10 col-xs-10">
                        <p class="title_prom"><i class="fas fa-asterisk icon_title"></i>  {{$offer->name}}</p>
                        <p class="desc_prom">

                        </p>
                    </div>
                </div>
                <div class="element_iconed">
                    <div class="row">
                        <div class="col-md-1">
                            <i class="far fa-smile icon_modal_big"></i>
                        </div>
                        <div class="col-md-11">
                            <p class="text_modal_inf" style="max-width: 450px !important; overflow-x: hidden">
                                {{$offer->description}}
                            </p>
                        </div>
                    </div>
                </div>


               <div class="row ">
                   <a href="{{$offer->restaurant_url}}" class="offset-4"><p class="link_to">Go see their page</p></a>
                </div>
            </div>
        </div>
    </div>
</div>