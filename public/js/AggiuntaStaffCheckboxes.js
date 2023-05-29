$(document).ready(function() {
    $('.container-check-boxes-aziende').show();
    // script che viene eseguito solo dopo che il campo all'interno della select viene cambiato
    $('#gestione_pacchetti').change(function () {
        if ( $(this).val() == 0){
            $('.container-check-boxes-aziende').show();
            $('input[name="aziende[]"]').prop('checked', false);
        }
        if ( $(this).val() == 1){
            $('.container-check-boxes-aziende').hide();
            $('input[name="aziende[]"]').prop('checked', true);
        }
    });
})
