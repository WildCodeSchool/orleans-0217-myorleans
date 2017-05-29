// initialisation des select de Materialize
$(document).ready(function() {
    $('select').material_select();
    $('.carousel').carousel(); //carousel init
    $('.carousel-slider').slider({full_width: true});//slider init


    $('.parallax').parallax();

    $('.modal').modal();
    // Script JS pour l'autocomplétion
    $('input.autocomplete').autocomplete({
        data: {
            "Orleans": null,
            "Olivet": null,
            "Saint-Jean-de-Braye": null,
            "Saint-Jean-de-la-Ruelle": null,
            "Saint-Jean-le-Blanc": null,
            "Saint-Hilaire-Saint-Mesmin": null,

        },
        limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
        onAutocomplete: function (val) {
            // Callback function when value is autcompleted.
        },
        minLength: 1, // The minimum length of the input for the autocomplete to start. Default: 1.
    });
});

