$(function () {



    $(":input").on('blur', function (event) {
        event.preventDefault();
        var formElementId = $(this).attr('id');
        doElemValidation(formElementId, actionUrl, formId);
    });

    $("#form_creazione_offerta").on('submit', function (event) {
        event.preventDefault();
        doFormValidation(actionUrl, formId);
    });
});

function getErrorHtml(id, elemErrors) {

    if (typeof elemErrors === 'undefined' || elemErrors.length < 1) {
        return '';
    }

    var newUl = document.createElement('ul');
    var newUlId = 'errors' + id;
    var newUlClass = 'errors';

    newUl.id = newUlId;
    newUl.className = newUlClass;

    for (var i = 0; i < elemErrors.length; i++) {


        var listItem = document.createElement('li');
        listItem.textContent = elemErrors[i];
        newUl.appendChild(listItem);


    }

    return newUl.outerHTML;
}

function getErrorHtmlSubmit(elemErrors) {

    if (typeof elemErrors === 'undefined' || elemErrors.length < 1) {
        return '';
    }

    // elimina tutti gli elementi in cui l'id inizia con "errors" ( tutte le liste degli errori)
    $('[id^="errors"]').remove();

    var fields = Object.keys(elemErrors);

    console.log(fields);

    for (var campo in fields) {

        var campoValue = fields[campo];

        var newUl = $('<ul>');


        if (elemErrors.hasOwnProperty(campoValue)) {
            var errors = elemErrors[campoValue];

            console.log(errors);

            for (var i = 0; i < errors.length; i++) {
                var errorMessage = errors[i];

                var listItem = $('<li>').text(errorMessage);
                newUl.append(listItem);
            }


            var newUlId = 'errors' + campoValue;
            var newUlClass = 'errors';

            newUl.attr('id', newUlId);
            newUl.addClass(newUlClass);
        }

        $('.container-dati-offerta input#' + campoValue).parent('.container-dati-offerta').after(newUl);

    }

}

function doElemValidation(id, actionUrl, formId) {

    var formElems;
    var elem = $("#" + id);

    inputVal = elem.val();


    formElems = new FormData();
    formElems.append(id, inputVal);
    addFormToken();
    sendAjaxReq();

    function addFormToken() {
        var tokenVal = $("#" + formId + " input[name=_token]").val();
        formElems.append('_token', tokenVal);
    }

    function sendAjaxReq() {

        $.ajax({
            type: 'POST',
            url: actionUrl,
            data: formElems,
            dataType: "json",
            error: function (data) {
                if (data.status === 422) {
                    var errMsgs = JSON.parse(data.responseText);

                    $('#errors' + id).remove();

                    for (var field in errMsgs) {
                        if (errMsgs.hasOwnProperty(field)) {
                            var errors = errMsgs[field];
                        }
                    }


                    $('.container-dati-offerta input#' + id).parent('.container-dati-offerta').after(getErrorHtml(id, errors[id]));


                }
            },
            contentType: false,
            processData: false
        });
    }
}

function doFormValidation(actionUrl, formId) {

    var form = new FormData(document.getElementById(formId));
    $.ajax({
        type: 'POST',
        url: actionUrl,
        data: form,
        dataType: "json",
        error: function (data) {
            if (data.status === 422) {
                var errMsgs = JSON.parse(data.responseText);
                $.each(errMsgs, function (id) {
                    if(id === 'errors'){
                        getErrorHtmlSubmit(errMsgs[id]);
                    }
                });
            }
        },
        contentType: false,
        processData: false
    });
}
