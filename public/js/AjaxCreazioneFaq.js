$(function () {
    // andiamo ad inserire nel wrap-set gli elementi di input tranne quello di submit,
    // ad ogni evento di perdita del focus (blur) viene attivato l'handler
    $(":input:not([type='submit'])").on('blur', function (event) {

        // recupera l'id dell'elemento che ha perso il focus
        var formElementId = $(this).attr('id');     // $(this) rappresenta $(":input")

        doElemValidation(formElementId, actionUrl, formId);
    });

    // viene messo all'interno del wrap-set gli elementi del DOM che hanno come id #form_creazione_faq
    // ed in seguito viene associato un event handler per la gestione della submit
    $('#form_creazione_faq').on('submit', function (event) {

        // ferma il meccanismo di default che si avrebbe durante il processo di submit dei dati di una form
        //utilizzato per validare i dati di un modulo prima di inviare i dati al server senza aggiornare la pagina
        event.preventDefault();

        doFormValidation(actionUrl, formId);
    });

});

// La funzione `doElemValidation()` esegue la validazione di un elemento
// di input e invia una richiesta asincrona al server utilizzando AJAX.
function doElemValidation(id, actionUrl, formId) {

    var formElems;

    // viene ricostruito l'id dell'elemento che ha perso il focus
    var elem = $("#" + id);
    // viene salvato il valore che ha l'elemento di cui si è stabilito l'id
    inputVal = elem.val();

    // viene creato un nuovo oggetto di FormData() per manipolare gli elementi di input e i corrispettivi valori della form
    formElems = new FormData();
    // Aggiunge la coppia chiave-valore all'oggetto formElems
    formElems.append(id, inputVal);

    addFormToken(); // Aggiunge il token della form all'oggetto formElems

    sendAjaxReq(); // Invia la richiesta AJAX al server

    // aggiunge al FormData il token della form
    function addFormToken() {
        // costruisce l'id del token stesso e ne prende il valore
        var tokenVal = $("#" + formId + " input[name=_token]").val();

        //aggiunge al formData il token e il suo valore
        formElems.append('_token', tokenVal);
    }

    // funzione che manda la richiesta asincrona ajax al server
    function sendAjaxReq() {

        // $.ajax è una funzione che permette di inviare richieste asincrone al server invece di aspettare ogni
        // volta che il server risponda ad una richiesta tramite il protocollo HTTP.
        $.ajax({
            type: 'POST',   // viene definito il tipo di verbo da utilizzare ( 'GET' o 'POST' )
            url: actionUrl,     // definisce la rotta a cui inviare la richiesta nel metodo sopra descritto per effettuare la validazione
            data: formElems,       // definisce i dati inviati tramite la richiesta al server
            dataType: "json",       // indica il tipo di dati che ci si aspetta di ricevere come risposta dal serverr

            // nel caso in cui ci sia un errore all'interno della richiesta viene eseguito ciò che sta dentro
            // la function(data){} che ha come parametro i dati di errore ritornati dal server in formato json
            error: function (data) {

                // Questo stato viene restituito quando la richiesta è stata ricevuta dal server,
                // ma non è stata elaborata correttamente a causa di errori nei dati inviati.
                if (data.status === 422) {

                    // La funzione JSON.parse() analizza una stringa JSON e restituisce un oggetto JavaScript che rappresenta
                    // i dati contenuti nella stringa JSON. In questo caso, la stringa JSON rappresenta gli errori inviati dal server.
                    var errMsgs = JSON.parse(data.responseText); // costituito da tutti gli errori in json più message

                    // viene utilizzato per rimuovere il messaggio di errore se già presente
                    // rimuove tutti gli elementi all'interno del DOM che hanno un id pari a
                    // 'errors{id_elemento_dom_perso_focus}'.
                    $('#errors' + id).remove();
                    // itera in tutti i campi dell'errore su cui è stato già fatto il parsing del json
                    for (var field in errMsgs) {
                        // determina se il campo iterato è una proprietà diretta di errMsgs o se è una proprietà
                        // passata alla variabile per ereditarietà ( come nel caso del message )
                        if (errMsgs.hasOwnProperty(field)) {
                            var errors = errMsgs[field]; // prende gli errori associati a tutti i campi inviati con la richiesta
                        }
                    }
                    // determina qual è il div con classe '.container-dati-offerta' che ha come figlio un id pari
                    // a quello specificato, e, a seguito di questo, tramite .after, posiziona nel DOM gli elementi
                    // che vengono ritornati dalla funzione getErrorHtml(id, errors[id])
                    $('#' + id).parent('.container-dati_form_descrizione').after(getErrorHtml(id, errors[id]));

                }
            },
            // disabilita l'impostazione automatica del tipo di contenuto della richiesta HTTP
            contentType: false,
            // disabilita la funzione di conversione dei dati in formato JSON poichè
            // sono già nel formato desiderato
            processData: false
        });
    }
}

// Funzione che prima verifica la presenza di errori e poi crea un nuovo elemento del DOM all'interno di una lista
// non ordinata nel quale vengono inseriti gli errori di validazione
function getErrorHtml(id, elemErrors){

    // se la lista degli errori passati a seguito della richiesta ajax ha una lunghezza pari a 0 o il tipo dei dati
    // ricevuti per un elemento con un determinato id è undefined, allora non sono stati trovati per l'elemento
    // con id ritrovato in precedenza
    if (typeof elemErrors === 'undefined' || elemErrors.length < 1) {
        return '';
    }

    // crea un nuovo elemento sul DOM che ha tag 'ul' ( lista non ordinata )
    var newUl = document.createElement('ul');
    // crea l'id per il nuovo elemento
    var newUlId = 'errors' + id;
    // crea la classe per il nuovo elemento
    var newUlClass = 'errors';

    // setta id e classe al nuovo elemento
    newUl.id = newUlId;
    newUl.className = newUlClass;

    for (var i = 0; i < elemErrors.length; i++) {
        // per ogni errore crea un nuovo elemento con tag pari a 'li'
        var listItem = document.createElement('li');
        // setta il testo del nuovo elemento della lista
        listItem.textContent = elemErrors[i];
        // aggiunge dentro al tag 'ul' i tag 'li' che corrispondono agli errori
        newUl.appendChild(listItem);

    }

    // ritorna la rappresentazione della lista appena creata come una stringa utilizzando newUl.outerHTML
    return newUl.outerHTML;
}
function doFormValidation(actionUrl, formId) {

    // crea un nuovo oggetto FormData che contiene tutti i dati con id pari a formId
    var form = new FormData(document.getElementById(formId));

    // $.ajax è una funzione che permette di inviare richieste asincrone al server invece di aspettare ogni
    // volta che il server risponda ad una richiesta tramite il protocollo HTTP.
    $.ajax({
        type: 'POST',   // viene definito il tipo di verbo da utilizzare ( 'GET' o 'POST' )
        url: actionUrl,     // definisce la rotta a cui inviare la richiesta nel metodo sopra descritto
        data: form,     // definisce i dati inviati con la richiesta al server
        dataType: "json",       // rappresenta la codifica dei dati che vengono ritornati dal server

        // nel caso in cui ci sia un errore all'interno della richiesta viene eseguito ciò che sta dentro
        // la function(data){} che ha come parametro i dati di errore ritornati dal server in formato json
        error: function (data) {
            // determina se gli errori sono causati da valori non validati o errati durante la richista
            if (data.status === 422) {

                // vengono salvati gli errori e i messaggi di errore (inviati dal server e parsati)
                // all'interno della variabile errMsgs
                var errMsgs = JSON.parse(data.responseText); // costituito da tutti gli errori e i messaggi di errore
                // errMsgs = [ errors(JSON), message ]


                //vengono gestiti gli errori restituiti dal server
                // e se l'id all'interno del each è 'errors' viene richiamata la
                // funzione getErrorHtmlSubmit
                $.each(errMsgs, function (id) {
                    // se l'id all'interno del loop è 'errors'
                    if(id === 'errors'){
                        getErrorHtmlSubmit(errMsgs[id]);
                    }
                });
            }
        },
        // in caso di successo della chiamata l'utente viene re-indirizzato
        // alla rotta definita all'interno di homeRoute
        success: function (data){
            window.location.href = homeRoute;
        },
        // disabilita l'impostazione automatica del tipo di contenuto della richiesta HTTP
        contentType: false,
        // disabilita la funzione di conversione dei dati in formato JSON poichè
        // sono già nel formato desiderato
        processData: false
    });
}

//funzione che prima verifica che l'array di errori che gli è stato passato come parametro
//non sia vuoto ed in seguito elimina gli elementi con id errors(che rappresentano
// gli errori già visualizzati) ed effettua un ciclo per ogni elemento della form nel quale
// per ciascun elemento crea una lista non ordinata nella quale vengono inseriti gli errori sotto forma di <li>
function getErrorHtmlSubmit(elemErrors) {

    // se la lista degli errori passati a seguito della richiesta ajax ha una lunghezza pari a 0 o il tipo dei dati
    // ricevuti per un elemento con un determinato id è undefined, allora non sono stati trovati per l'elemento
    // con id ritrovato in precedenza
    if (typeof elemErrors === 'undefined' || elemErrors.length < 1) {
        return '';
    }

    // elimina tutti gli elementi in cui l'id inizia con "errors" ( tutte le liste degli errori)
    $('[id^="errors"]').remove();

    // prende gli id della form (le chiavi) in cui sono presenti errori poichè elemErrors è un array chiave valore
    var fields = Object.keys(elemErrors);
    // effettua un ciclo per ogni elemento della form
    for (var campo in fields) {

        //prende l'elemento 0 e 1 di fields che corrispondono rispettivamente a "domanda" e "risposta"
        // salva l'elemento che sta analizzando al ciclo i-esimo
        var campoValue = fields[campo];
        // crea una nuova lista non ordinata
        var newUl = $('<ul>');

        // se il campo analizzato è una proprietà diretta di elemErrors entra nell'if
        if (elemErrors.hasOwnProperty(campoValue)) {

            // prende tutti gli errori associati al campo che si sta analizzando
            var errors = elemErrors[campoValue];

            for (var i = 0; i < errors.length; i++) {
                // prende l'i-esimo errore associato ad un elemento
                var errorMessage = errors[i];

                // crea un list item e associa il messaggio d'errore al testo
                var listItem = $('<li>').text(errorMessage);

                // immette all'interno della lista non ordinata il nuovo elemento 'li'
                newUl.append(listItem);
            }

            // genera id e classe della lista non ordinata
            var newUlId = 'errors' + campoValue;
            var newUlClass = 'errors';

            newUl.attr('id', newUlId);
            newUl.addClass(newUlClass);
        }

        // crea sul DOM la lista appena generata subito dopo il div '.container-dati-offerta' che ha come figlio
        // un elemento di input che ha id pari a campoValue
        $('#' + campoValue).parent('.container-dati_form_descrizione').after(newUl);

    }

}
