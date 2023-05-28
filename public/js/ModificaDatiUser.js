/*lo script prende il campo input dello username e lo disabilita in modo che l'utente non possa modificarlo.
* Il campo input viene preso tramite ID*/
$(document).ready(function() {
    $('#username-input').prop('readonly', true);
});
