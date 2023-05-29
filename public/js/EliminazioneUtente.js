$(document).ready(function() {

    // script che viene eseguito solo dopo che il campo all'interno della select viene cambiato
    $('#utenteUsername').change(function () {

        // prende il valore di tutte le offerte codificate in JSON direttamente da php
        console.log(utenti);

        // quando il valore cliccato sulla selection è diverso da '-' entra all'interno dell'if
        if ( $(this).val() !== '-') {

            // prende l'offerta che si trova alla posizione i-esima
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
            if(utenteSelezionato.flagPacchetti == 0){
                $('#gestione_pacchetti').val(0).change();
            }
            else{
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

