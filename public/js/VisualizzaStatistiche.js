$(document).ready(function() {
    //hide del container contenente informazioni aggiuntive
    $('.container-show_hide_stats').hide();

    var coupons = listaCoupon;

    //click su id di un offerta
    $('.container-offerta-Id').click( function (){
        $('.container-show_hide_stats').show();
        var idOffertaCliccata = $(this).text();

        var contatore = 0;

        var oggettoOfferta = "";

        //conto per il coupon cliccato il numero di coupon emessi in generale
        coupons.forEach(function(element, index) {
            if( idOffertaCliccata == element.id_offerta){
                oggettoOfferta = element.nome_offerta;
                contatore++;
            }
        });

        //setto il testo dentro il container contenente le informazioni aggiuntive
        $('#codice-offerta_id-utente').text("Offerta: "+ idOffertaCliccata + ", " + oggettoOfferta);
        $('#numero_coupon').text("Numero coupon emessi: " + contatore);

    })

    //click su id di un utente
    $('.container-cliente-Id').click( function (){
        $('.container-show_hide_stats').show();
        var idClienteSelezionato = $(this).text();

        var contatore = 0;
        var nomeCliente = "";
        var cognomeCliente = "";

        //conto il numero di coupon totali emessi dall'utente
        coupons.forEach(function(element, index) {
            if( idClienteSelezionato == element.id_cliente){
                nomeCliente = element.nome_cliente;
                cognomeCliente = element.cognome_cliente;
                contatore++;
            }
        });

        //setto il testo dentro il container con informazioni aggiuntive
        $('#codice-offerta_id-utente').text("Cliente selezionato: "+ idClienteSelezionato + ", " + nomeCliente + " "+ cognomeCliente);
        $('#numero_coupon').text("Numero coupon emessi: " + contatore);


    })


})
