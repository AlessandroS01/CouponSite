$(document).ready(function() {

    $('.container-logo-modifica_azienda').hide();

    // il wrapset e composto da tutti gli elementi
    // che hanno id = nomeAzienda, e a questo wrapset agganciamo l'event
    // handler che attiva la funzione al cambiamento del valore degli elementi del wrapset
    $('#nomeAzienda').change(function () {

        // quando il valore cliccato sulla select è diverso da '-' entra all'interno dell'if
        if ( $(this).val() !== '-') {

            // viene salvata nella variabile aziendaSelezionata l'azienda che si trova alla posizione i-esima
            var aziendaSelezionata = aziende[ $(this).val() ];


            //impostazione valori attuali dell'azienda all'interno degli input
            $('#partita_iva').val(aziendaSelezionata.partita_iva);
            $('#nome').val(aziendaSelezionata.nome);
            $('#localita').val(aziendaSelezionata.localita);
            $('#email').val(aziendaSelezionata.email);
            $('#telefono').val(aziendaSelezionata.telefono);
            $('#tipologia').val(aziendaSelezionata.tipologia);
            $('#ragione_sociale').val(aziendaSelezionata.ragione_sociale);
            $('#descrizione').val(aziendaSelezionata.descrizione);

            $('.container-logo-modifica_azienda').show();

            //definiamo il path dell'immagine attuale dell'azienda
            var logo = public_url + '/' + aziendaSelezionata.logo;
            // impostiamo il path nell'attributo src dell'immagine per avere una preview
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
