//vengono resi non modificabili tutti i campi di input tranne il nome, il cognome
// e il bottone submit nella form di modifica dei dati dello staff
$(document).ready(function() {
    $('input:not(#nome-input):not(#cognome-input):not(#submit-modifica)').prop('readonly', true);

    $('#genere-input').prop('disabled', true);
});
