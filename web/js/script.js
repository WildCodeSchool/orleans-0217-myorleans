// initialisation des select de Materialize

$(document).ready(function () {
    $('.parallax').parallax();
});

$(document).ready(function () {
    $('select').material_select();

    $('.modal').modal();
    // Script JS pour l'autocomplétion

    $('.carousel').carousel({
        indicators: true,
        dist: 0,
        shift: 20,
        duration: 100
    });

});
