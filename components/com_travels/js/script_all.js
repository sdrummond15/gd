jQuery(document).ready(function ($) {

    $(window).on('resize', function () {
        var altura = $('.img-travel').width();
        $('.img-travel').css('height', altura * 0.75);
    }).trigger('resize');

    $('#carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 210,
        itemMargin: 5,
        asNavFor: '#slider'
    });

    $('#slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#carousel"
    });

    $('.flex-next').html('');
});