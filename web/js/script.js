// initialisation des select de Materialize
$(document).ready(function() {
    $('select').material_select();
    $('.carousel').carousel({
        indicators:true,
        dist: 0,
        shift: 20,
/*
        padding: 100,
*/
        duration: 100
    });
});
