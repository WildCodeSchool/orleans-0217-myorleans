
/* --------------------------------------------------------------------*/
/* -----SCRIPT JS POUR L'INCREMENTATION DES CHIFFRES - PAGE L'AGENCE -----*/
/* --------------------------------------------------------------------*/

$('.count').each(function () {
    var $this = $(this);
    jQuery({ Counter: 0 }).animate({ Counter: $this.text() }, {
        duration: 4000,
        easing: 'swing',
        step: function (i) {
            $this.text(Math.ceil(i));
        }
    });
});
