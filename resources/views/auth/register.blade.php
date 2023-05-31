@extends('layouts.public')

@section('title', 'Registrazione')

@section('link')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('css/autenticazione.css') }}" >

@endsection

@section('content')
<div class="container-register">
    <h1>Registrazione</h1>
    <p>Utilizza questa form per registrarti al sito</p>
    <div class="form-registrazione">
        <div class="container-form-register">
            <div>
                {{ Form::open(array('class' => 'contact-form', 'method' => 'POST', 'id'=>'form_registrazione')) }}
                @csrf
                <div  class="container-dati-registrazione">
                    {{ Form::label('nome', 'Nome', ['class' => 'label-input']) }}
                    {{ Form::text('nome', '', ['class' => 'input', 'id' => 'nome']) }}
                </div>

                <div  class="container-dati-registrazione">
                    {{ Form::label('cognome', 'Cognome', ['class' => 'label-input']) }}
                    {{ Form::text('cognome', '', ['class' => 'input', 'id' => 'cognome']) }}
                </div>

                 <div  class="container-dati-registrazione">
                    {{ Form::label('email', 'Email', ['class' => 'label-input']) }}
                    {{ Form::text('email', '', ['class' => 'input','id' => 'email']) }}
                </div>

                 <div  class="container-dati-registrazione">
                    {{ Form::label('username', 'Username', ['class' => 'label-input']) }}
                    {{ Form::text('username', '', ['class' => 'input','id' => 'username']) }}
                </div>

                <div  class="container-dati-registrazione">
                    {{ Form::label('password', 'Password', ['class' => 'label-input']) }}
                    {{ Form::password('password', ['class' => 'input', 'id' => 'password']) }}

                </div>

                <div  class="container-dati-registrazione">
                    {{ Form::label('password-confirm', 'Conferma password', ['class' => 'label-input']) }}
                    {{ Form::password('password_confirmation', ['class' => 'input', 'id' => 'password_confirm']) }}
                </div>
            </div>

            <div>
                <div class="container-dati-registrazione ">
                    {{ Form::label('genere', 'Genere', ['class' => 'label-input']) }}
                    {{ Form::select('genere', ['M' => 'M', 'F' => 'F'], null, ['class' => 'input', 'id' => 'genere']) }}

                </div>

                <div class="container-dati-registrazione">
                    {{ Form::label('eta', 'Età', ['class' => 'label-input']) }}
                    {{ Form::text('eta', '', ['class' => 'input', 'id' => 'eta']) }}
                </div>

                <div class="container-dati-registrazione">
                    {{ Form::label('telefono', 'Telefono', ['class' => 'label-input']) }}
                    {{ Form::text('telefono', '', ['class' => 'input', 'id' => 'telefono']) }}
                </div>

                <div class="container-dati-registrazione">
                    {{ Form::label('via', 'Via', ['class' => 'label-input']) }}
                    {{ Form::text('via', '', ['class' => 'input', 'id' => 'via']) }}

                </div>

                <div class="container-dati-registrazione">
                    {{ Form::label('numero_civico', 'Numero Civico', ['class' => 'label-input']) }}
                    {{ Form::text('numero_civico', '', ['class' => 'input', 'id' => 'numero_civico']) }}
                </div>


                <div class="container-dati-registrazione">
                    {{ Form::label('citta', 'Città', ['class' => 'label-input']) }}
                    {{ Form::text('citta', '', ['class' => 'input', 'id' => 'citta']) }}
                </div>

            </div>
        </div>

        <div class="container-autenticazione_button">
                {{ Form::submit('Registrati', ['class' => 'submit-button']) }}
        </div>


        {{ Form::close() }}
    </div>

</div>




<script>
    $(function () {

        var actionUrl = "{{ route('register') }}";
        var formId = 'form_registrazione';

        $(":input").on('blur', function (event) {
            event.preventDefault();
            var formElementId = $(this).attr('id');
            doElemValidation(formElementId, actionUrl, formId);
        });

        $("#form_registrazione").on('submit', function (event) {
            event.preventDefault();
            doFormValidation(actionUrl, formId);
        });
    });

    function getErrorHtml(id, elemErrors) {
        if (typeof elemErrors === 'undefined' || elemErrors.length < 1) {
            return '';
        }


        var newUl = $('<ul>');


        var newUlId = 'errors[' + id + ']';
        var newUlClass = 'errors';

        newUl.attr('id', newUlId);
        newUl.addClass(newUlClass);


        for (var i = 0; i < elemErrors.length; i++) {
            var listItem = $('<li>').text(elemErrors[i]);
            newUl.append(listItem);
        }

        return newUl;
    }

    function getErrorHtmlSubmit(elemErrors) {
        if (typeof elemErrors === 'undefined' || elemErrors.length < 1) {
            return '';
        }

        var fields = Object.keys(elemErrors);

        for (var campo in fields) {

            var newUl = $('<ul>');

            var campoValue = fields[campo];

            if (elemErrors.hasOwnProperty(campoValue)) {
                var errors = elemErrors[campoValue];

                for (var i = 0; i < errors.length; i++) {
                    var errorMessage = errors[i];

                    var listItem = $('<li>').text(errorMessage);
                    newUl.append(listItem);
                }


                var newUlId = 'errors[' + campoValue + ']';
                var newUlClass = 'errors';

                newUl.attr('id', newUlId);
                newUl.addClass(newUlClass);
            }

            $('#errors\\[' + campoValue + '\\]').remove();

            $('.container-dati-registrazione input#' + campoValue).parent('.container-dati-registrazione').after(newUl);


        }

    }

    function doElemValidation(id, actionUrl, formId) {

        var formElems;
        var elem = $("#" + id);

        // elemento di input type != file
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
                        for (var field in errMsgs) {
                            if (errMsgs.hasOwnProperty(field)) {
                                var errors = errMsgs[field];
                            }
                        }

                        $('#errors\\[' + id + '\\]').remove();


                        if(id != 'password' || id != 'password_confirm'){
                            $('.container-dati-registrazione input#' + id).parent('.container-dati-registrazione').after(getErrorHtml(id, errors[id]));
                        }else{

                        }

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
            success: function (data) {
                window.location.replace(data.redirect);
            },
            contentType: false,
            processData: false
        });
    }
</script>



@endsection

