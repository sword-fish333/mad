$(function () {
    $(document).scroll(function () {
        var $nav = $(".navigator");
        $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());
    });
});

$(document).ready(function(){
    var width = $('#for_map').width();
    var canvas = $('#map_apart')[0];
    console.log(canvas);
    canvas.width = width;
    $(window).resize(function(){
        width = $('#for_map').width();
        canvas.width = width;
    });
});

$(document).ready(function(){
    $(".downarr").click(function() {
        $('html,body').animate({
                scrollTop: $(".go_bot_div").offset().top},
            'slow');
    });
});
