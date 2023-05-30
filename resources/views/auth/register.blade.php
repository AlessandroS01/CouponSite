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
                {{ Form::open(array('route' => 'register', 'class' => 'contact-form', 'method' => 'POST', 'id'=>'form_registrazione')) }}

                <div  class="container-dati-registrazione">
                    {{ Form::label('nome', 'Nome', ['class' => 'label-input']) }}
                    {{ Form::text('nome', '', ['class' => 'input', 'id' => 'nome']) }}

                </div>
                @if ($errors->first('nome'))
                    <ul class="errors">
                        @foreach ($errors->get('nome') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif

                <div  class="container-dati-registrazione">
                    {{ Form::label('cognome', 'Cognome', ['class' => 'label-input']) }}
                    {{ Form::text('cognome', '', ['class' => 'input', 'id' => 'cognome']) }}

                </div>
                @if ($errors->first('cognome'))
                    <ul class="errors">
                        @foreach ($errors->get('cognome') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif

                 <div  class="container-dati-registrazione">
                    {{ Form::label('email', 'Email', ['class' => 'label-input']) }}
                    {{ Form::text('email', '', ['class' => 'input','id' => 'email']) }}

                </div>
                @if ($errors->first('email'))
                    <ul class="errors">
                        @foreach ($errors->get('email') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif

                 <div  class="container-dati-registrazione">
                    {{ Form::label('username', 'Username', ['class' => 'label-input']) }}
                    {{ Form::text('username', '', ['class' => 'input','id' => 'username']) }}

                </div>
                @if ($errors->first('username'))
                    <ul class="errors">
                        @foreach ($errors->get('username') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif

                <div  class="container-dati-registrazione">
                    {{ Form::label('password', 'Password', ['class' => 'label-input']) }}
                    {{ Form::password('password', ['class' => 'input', 'id' => 'password']) }}

                </div>
                @if ($errors->first('password'))
                    <ul class="errors">
                        @foreach ($errors->get('password') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif

                <div  class="container-dati-registrazione">
                    {{ Form::label('password-confirm', 'Conferma password', ['class' => 'label-input']) }}
                    {{ Form::password('password_confirmation', ['class' => 'input', 'id' => 'password-confirm']) }}
                </div>
            </div>

            <div>
                <div class="container-dati-registrazione ">
                    {{ Form::label('genere', 'Genere', ['class' => 'label-input']) }}
                    {{ Form::select('genere', ['M' => 'M', 'F' => 'F'], null, ['class' => 'input', 'id' => 'genere']) }}

                </div>
                @if ($errors->first('genere'))
                    <ul class="errors">
                        <li>{{ $errors->first('genere') }}</li>
                    </ul>
                @endif

                <div class="container-dati-registrazione">
                    {{ Form::label('eta', 'Età', ['class' => 'label-input']) }}
                    {{ Form::text('eta', '', ['class' => 'input', 'id' => 'eta']) }}

                </div>
                @if ($errors->first('eta'))
                    <ul class="errors">
                        @foreach ($errors->get('eta') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="container-dati-registrazione">
                    {{ Form::label('telefono', 'Telefono', ['class' => 'label-input']) }}
                    {{ Form::text('telefono', '', ['class' => 'input', 'id' => 'telefono']) }}
                </div>
                @if ($errors->first('telefono'))
                    <ul class="errors">
                        @foreach ($errors->get('telefono') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="container-dati-registrazione">
                    {{ Form::label('via', 'Via', ['class' => 'label-input']) }}
                    {{ Form::text('via', '', ['class' => 'input', 'id' => 'via']) }}

                </div>
                @if ($errors->first('via'))
                    <ul class="errors">
                        @foreach ($errors->get('via') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="container-dati-registrazione">
                    {{ Form::label('numero_civico', 'Numero Civico', ['class' => 'label-input']) }}
                    {{ Form::text('numero_civico', '', ['class' => 'input', 'id' => 'numero_civico']) }}

                </div>
                @if ($errors->first('numero_civico'))
                    <ul class="errors">
                        @foreach ($errors->get('numero_civico') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif

                <div class="container-dati-registrazione">
                    {{ Form::label('citta', 'Città', ['class' => 'label-input']) }}
                    {{ Form::text('citta', '', ['class' => 'input', 'id' => 'citta']) }}

                </div>
                @if ($errors->first('citta'))
                    <ul class="errors">
                        @foreach ($errors->get('citta') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
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
            var formElementId = $(this).attr('id');
            doElemValidation(formElementId, actionUrl, formId);
        });
        $("#form_registrazione").on('submit', function (event) {
            event.preventDefault();
            doFormValidation(actionUrl, formId);
        });
    });

    function getErrorHtml(elemErrors) {
        if (typeof elemErrors === 'undefined' || elemErrors.length < 1) {
            return '';
        }

        var out = '<div><ul class="errors">';
        for (var i = 0; i < elemErrors.length; i++) {
            out += '<li>' + elemErrors[i] + '</li>';
        }
        out += '</ul></div>';
        return out;
    }

    function doElemValidation(id, actionUrl, formId) {

        var formElems;
        var elem = $("#" + id);

        if (elem.attr('type') === 'file') {
            // elemento di input type=file valorizzato
            if (elem.val() !== '') {
                inputVal = elem.get(0).files[0];
            } else {
                inputVal = new File([""], "");
            }
        } else {
            // elemento di input type != file
            inputVal = elem.val();
        }

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
                        console.log(id);
                        $("#" + id).siblings('.errors').remove(); // Rimuovi gli errori precedenti
                        console.log(getErrorHtml(errMsgs[id]));
                        $("#" + id).after(getErrorHtml(errors[id]));
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
                        $("#" + id).siblings('.errors').remove(); // Rimuovi gli errori precedenti
                        $("#" + id).after(getErrorHtml(errMsgs[id]));
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

