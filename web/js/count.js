
/* --------------------------------------------------------------------*/
/* -----SCRIPT JS POUR L'INCREMENTATION DES CHIFFRES - PAGE L'AGENCE -----*/
/* --------------------------------------------------------------------*/

$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 4000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});