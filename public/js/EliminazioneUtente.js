$(document).ready(function() {

    // il wrapset e composto da tutti gli elementi
    // che hanno id = utenteUsername, e a questo wrapset agganciamo l'event
    // handler che attiva la funzione al cambiamento del valore degli elementi del wrapset
    $('#utenteUsername').change(function () {

        // quando il valore cliccato sulla select è diverso da '-' entra all'interno dell'if
        if ( $(this).val() !== '-') {

            // viene salvata nella variabile utenteSelezionato l'utente che si trova alla posizione i-esima
            var utenteSelezionato = utenti[ $(this).val() ];

            // popola tutti i campi della form
            $('#utenteId').val(utenteSelezionato.id);
            $('#nome').val(utenteSelezionato.nome);
            $('#cognome').val(utenteSelezionato.cognome);
            $('#email').val(utenteSelezionato.email);
            $('#username').val(utenteSelezionato.username);
            $('#genere').val(utenteSelezionato.genere);
            $('#eta').val(utenteSelezionato.eta);
            $('#telefono').val(utenteSelezionato.telefono);
            $('#via').val(utenteSelezionato.via);
            $('#numero_civico').val(utenteSelezionato.numero_civico);
            $('#citta').val(utenteSelezionato.citta);

            //costrutto utilizzato solo nell'eliminazione dello staff
            //viene controllato il flagPacchetti dell'utente da cancellare
            if(utenteSelezionato.flagPacchetti == 0){

                // se il flag è = 0 imposta il valore dell'elemento con
                // ID "gestione_pacchetti" a 0 e scatena l'evento "change()"
                $('#gestione_pacchetti').val(0).change();
            }
            else{

                //se il flag è = 1 imposta il valore dell'elemento
                // "gestione_pacchetti" a 1 e scatena l'evento "change()"
                $('#gestione_pacchetti').val(1).change();
            }

            // se invece si seleziona '-' tutti i campi vengono resettati
        }else{
            $('#utenteId').val("");
            $('#nome').val("");
            $('#cognome').val("");
            $('#email').val("");
            $('#username').val("");
            $('#genere').val("");
            $('#eta').val("");
            $('#telefono').val("");
            $('#via').val("");
            $('#numero_civico').val("");
            $('#citta').val("");
            $('#gestione_pacchetti').val(0).change();
        }

    });
})

