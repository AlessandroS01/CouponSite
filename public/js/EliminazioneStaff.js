$(document).ready(function() {

    // script che viene eseguito solo dopo che il campo all'interno della select viene cambiato
    $('#staffUsername').change(function () {

        // serve a determinare se da template vengono passati i vari membri dello staff
        console.log(utentiStaff);

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
