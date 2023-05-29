
$(document).ready(function() {
    // script che viene eseguito solo dopo che il campo all'interno della select viene cambiato
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
