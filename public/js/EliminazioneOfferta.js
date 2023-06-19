$(document).ready(function() {

    // il wrapset e composto da tutti gli elementi
    // che hanno id = offerta, e a questo wrapset agganciamo l'event
    // handler che attiva la funzione al cambiamento del valore degli elementi del wrapset
    $('#offerta').change(function () {

        // prende il valore di tutte le aziende codificate in JSON direttamente da php
        console.log(aziende);
        // prende il valore di tutte le offerte codificate in JSON direttamente da php
        console.log(offerte);


        // quando il valore cliccato sulla selection è diverso da '-' entra all'interno dell'if
        if ( $(this).val() !== '-') {

            // prende l'offerta che si trova alla posizione i-esima
            var oggettoOffertaSelezionata = offerte[ $(this).val() ];
            // variabile che serve a contenere il nome dell'azienda relativa a quell'offerta perchè
            // all'interno della tabella Offerta è presente come chiave esterna la partita_iva e non il nome
            var azienda = null;

            // crea un loop con un indice al più pari alla lunghezza dell'array contenente tutte le aziende
            for( var i = 0; i < aziende.length; i++){
                // quando la partita iva dell'offerta selezionata è pari alla partita iva di un'azienda presente
                // all'interno dell'array contenente tutte le aziende setta il valore della variabile azienda
                // uguale al nome dell'azienda stessa
                if(aziende[i].partita_iva == oggettoOffertaSelezionata.azienda){
                    azienda = aziende[i].nome;
                }
            }
            // popola tutti i campi della form
            // Dato che per la modifica è necessario anche sapere il codice dell'offerta che si vuole modificare,
            // viene inviato anche un parametro hidden contenente il valore del codice dell'offerta selezionata.
            $('#hidden_param').val(oggettoOffertaSelezionata.codice);
            $('#oggetto_offerta').val(oggettoOffertaSelezionata.oggetto_offerta);
            $('#data_scadenza').val(oggettoOffertaSelezionata.data_scadenza);
            $('#luogo_fruizione').val(oggettoOffertaSelezionata.luogo_fruizione);
            $('#modalita_fruizione').val(oggettoOffertaSelezionata.modalita_fruizione);
            $('#percentuale_sconto').val(oggettoOffertaSelezionata.percentuale_sconto);
            $('#prezzo_pieno').val(oggettoOffertaSelezionata.prezzo_pieno);
            $('#categoria').val(oggettoOffertaSelezionata.categoria);
            // questa parte permette di non poter modificare l'azienda che ha emesso la promozione
            $('#azienda').val(azienda).prop('readonly', true);
            $('#descrizione').val(oggettoOffertaSelezionata.descrizione);

            // se invece si seleziona '-' tutti i campi vengono resettati
        }else{
            $('#oggetto_offerta').val("");
            $('#data_scadenza').val("");
            $('#luogo_fruizione').val("");
            $('#modalita_fruizione').val("");
            $('#percentuale_sconto').val("");
            $('#prezzo_pieno').val("");
            $('#categoria').val("");
            $('#azienda').val("").prop('readonly', true);
            $('#descrizione').val("");
            $('#hidden_param').val("");
        }

    });
});
