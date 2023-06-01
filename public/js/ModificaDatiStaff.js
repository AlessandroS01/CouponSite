
$(document).ready(function() {
    $('input:not(#nome-input):not(#cognome-input):not(#submit-modifica)').prop('readonly', true);

    $('#genere-input').prop('disabled', true);
});
