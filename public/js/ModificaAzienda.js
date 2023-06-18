$(document).ready(function() {

    $('.container-logo-modifica_azienda').hide();

    // script che viene eseguito solo dopo che il campo all'interno della select viene cambiato
    $('#nomeAzienda').change(function () {



        // quando il valore cliccato sulla selection è diverso da '-' entra all'interno dell'if
        if ( $(this).val() !== '-') {

            // prende l'azienda che si trova alla posizione i-esima, il $(this) si riferisce al valore passato dall'input con id=nomeAzienda
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
