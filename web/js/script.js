// initialisation des select de Materialize

$(document).ready(function () {
    $('select').material_select();
    $('.parallax').parallax();

    $('.carousel').carousel({
        indicators: true,
        dist: 0,
        shift: 20,
        duration: 100
    });



    $('.modal').modal();
    // Script JS pour l'autocomplétion

    // hide #back-top first
    $("#back-top").hide();

    // fade in #back-top
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#back-top').fadeIn();
            } else {
                $('#back-top').fadeOut();
            }
        });

        // scroll body to 0px on click
        $('#back-top a').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });

    $('#alert_close').click(function(){
        $( "#alert_box" ).fadeOut( "slow", function() {
        });
    });
});
