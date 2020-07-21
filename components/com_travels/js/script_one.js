jQuery(document).ready(function ($) {

    $(window).on('resize', function () {
        var altura = $('#lightgallery li').width();
        $('#lightgallery li').css('height', parseInt(altura * 0.75));
    }).trigger('resize');

    $('#lightgallery').lightGallery();
});