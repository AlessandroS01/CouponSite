$(document).ready(function() {

    $('.container-logo-modifica_azienda').hide();

    // script che viene eseguito solo dopo che il campo all'interno della select viene cambiato
    $('#nomeAzienda').change(function () {



        // quando il valore cliccato sulla selection è diverso da '-' entra all'interno dell'if
        if ( $(this).val() !== '-') {

            // prende l'offerta che si trova alla posizione i-esima
            var aziendaSelezionata = aziende[ $(this).val() ];



            $('#partita_iva').val(aziendaSelezionata.partita_iva);
            $('#nome').val(aziendaSelezionata.nome);
            $('#localita').val(aziendaSelezionata.localita);
            $('#email').val(aziendaSelezionata.email);
            $('#telefono').val(aziendaSelezionata.telefono);
            $('#tipologia').val(aziendaSelezionata.tipologia);
            $('#ragione_sociale').val(aziendaSelezionata.ragione_sociale);
            $('#descrizione').val(aziendaSelezionata.descrizione);

            $('.container-logo-modifica_azienda').show();

            var logo = public_url + '/' + aziendaSelezionata.logo;
            console.log(logo);
            $("#logo-preview").attr("src", logo);





            // se invece si seleziona '-' tutti i campi vengono resettati
        }else{
            $('#partitaIvaAzienda').val("");
            $('#partita_iva').val("");
            $('#nome').val("");
            $('#localita').val("");
            $('#email').val("");
            $('#telefono').val("");
            $('#tipologia').val("");
            $('#ragione_sociale').val("");
            $('#descrizione').val("");
            $('.container-logo-modifica_azienda').hide();
        }

    });
})
