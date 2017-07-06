// initialisation des select de Materialize

$(document).ready(function () {
    $('.parallax').parallax();

    $('.carousel').carousel({
        indicators: true,
        dist: 0,
        shift: 20,
        duration: 100
    });
});

$(document).ready(function () {
    $('select').material_select();

    $('.modal').modal();
    // Script JS pour l'autocomplétion

});
