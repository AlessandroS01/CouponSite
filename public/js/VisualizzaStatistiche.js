$(document).ready(function() {

    $('.container-show_hide_stats').hide();

    var coupons = listaCoupon;
    console.log(coupons);

    $('.container-offerta-Id').click( function (){
        $('.container-show_hide_stats').show();
        var idOffertaCliccata = $(this).text();

        var contatore = 0;

        var oggettoOfferta = "";

        coupons.forEach(function(element, index) {
            if( idOffertaCliccata == element.id_offerta){
                oggettoOfferta = element.nome_offerta;
                contatore++;
            }
        });

        $('#codice-offerta_id-utente').text("Offerta: "+ idOffertaCliccata + ", " + oggettoOfferta);
        $('#numero_coupon').text("Numero coupon emessi: " + contatore);

    })

    $('.container-cliente-Id').click( function (){
        $('.container-show_hide_stats').show();
        var idClienteSelezionato = $(this).text();

        var contatore = 0;
        var nomeCliente = "";
        var cognomeCliente = "";

        coupons.forEach(function(element, index) {
            if( idClienteSelezionato == element.id_cliente){
                nomeCliente = element.nome_cliente;
                cognomeCliente = element.cognome_cliente;
                contatore++;
            }
        });

        $('#codice-offerta_id-utente').text("Cliente selezionato: "+ idClienteSelezionato + ", " + nomeCliente + " "+ cognomeCliente);
        $('#numero_coupon').text("Numero coupon emessi: " + contatore);


    })


})
