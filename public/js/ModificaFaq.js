
$(document).ready(function() {
    // il wrapset e composto da tutti gli elementi
    // che hanno id = faq, e a questo wrapset agganciamo l'event
    // handler che attiva la funzione al cambiamento del valore degli elementi del wrapset
    $('#faq').change(function () {

        // quando il valore cliccato sulla selection è diverso da '-' entra all'interno dell'if
        if ( $(this).val() !== '-') {

            // prende l'offerta che si trova alla posizione i-esima
            var oggettoFaqSelezionata = faqs[ $(this).val() ];


            // popola tutti i campi della form
            $('#hidden_param').val(oggettoFaqSelezionata.id);


            $('#domanda').val(oggettoFaqSelezionata.domanda);
            $('#risposta').val(oggettoFaqSelezionata.risposta);

            // se invece si seleziona '-' tutti i campi vengono resettati
        }else{
            $('#domanda').val("");
            $('#risposta').val("");
            $('#hidden_param').val("");
        }

    });
})
