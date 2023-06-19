$(document).ready(function() {

    // script che viene eseguito quando cambio il valore della select
    // all'interno delle view aggiunta_staff e modifica_staff
    $('#gestione_pacchetti').change(function () {

        //gestione pacchetti nella select = no
        if ( $(this).val() == 0){
            $('.container-check-boxes-aziende').show();
            $('input[name="aziende[]"]').prop('checked', false);
        }
        //gestione pacchetti nella select = si, viene fatto l'hide delle checkbox
        //e vengono tutte checkate
        if ( $(this).val() == 1){
            $('.container-check-boxes-aziende').hide();
            $('input[name="aziende[]"]').prop('checked', true);
        }
    });

    // script che viene eseguito quando cambio il valore della select
    // all'interno delle view eliminazione_staff e modifica_staff
    $('#staffUsername').change(function () {

        // quando il valore cliccato sulla selection è diverso da '-' entra all'interno dell'if
        if ( $(this).val() !== '-') {

            // prende l'offerta che si trova alla posizione i-esima
            var staffSelezionato = utentiStaff[ $(this).val() ];

            // popola tutti i campi della form
            $('#staffId').val(staffSelezionato.id);
            $('#nome').val(staffSelezionato.nome);
            $('#cognome').val(staffSelezionato.cognome);
            $('#email').val(staffSelezionato.email);
            $('#username').val(staffSelezionato.username);
            $('#genere').val(staffSelezionato.genere);
            $('#eta').val(staffSelezionato.eta);
            $('#telefono').val(staffSelezionato.telefono);
            $('#via').val(staffSelezionato.via);
            $('#numero_civico').val(staffSelezionato.numero_civico);
            $('#citta').val(staffSelezionato.citta);
            if(staffSelezionato.flagPacchetti == 0){
                $('#gestione_pacchetti').val(0).change();
            }
            else{
                $('#gestione_pacchetti').val(1).change();
            }

            // se invece si seleziona '-' tutti i campi vengono resettati
        }else{
            $('#staffId').val("");
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
