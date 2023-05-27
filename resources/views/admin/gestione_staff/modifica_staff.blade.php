@extends('layouts.public')

@section('title', 'Modifica staff')

@section('content')


        <div class="container-offerta_dettagli">
            <h1> Modifica staff</h1>
        </div>

        @isset($staff)
        <div class="container-form">
            <div class="form">

                <div>
                    @isset($usernameUtentiStaff)
                        <div  class="container-dati_form">
                            {{ Form::label('staff', 'Staff', ['class' => 'label-input']) }}

                            {{ Form::select('staff', [ '-' => '-'] + $usernameUtentiStaff, null, ['class' => 'input', 'id' => 'staffUsername']) }}
                        </div>
                    @endisset
                </div>

                <div class="container-form-gestione">
                    <div>
                        {{ Form::open(array('route' => 'modifica staff', 'class' => 'contact-form', 'method' => 'POST')) }}

                        <div  class="container-dati_form">
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

                        <div  class="container-dati_form">
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

                        <div  class="container-dati_form">
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

                        <div  class="container-dati_form">
                            {{ Form::label('username', 'Username', ['class' => 'label-input']) }}
                            {{ Form::text('username', '', ['class' => 'input','id' => 'username', 'readonly' => 'readonly']) }}

                        </div>
                        @if ($errors->first('username'))
                            <ul class="errors">
                                @foreach ($errors->get('username') as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <div class="container-dati_form">
                            {{ Form::label('genere', 'Genere', ['class' => 'label-input']) }}
                            {{ Form::select('genere', ['-'=> '-', 'M' => 'M', 'F' => 'F'], null, ['class' => 'input', 'id' => 'genere']) }}

                        </div>
                        @if ($errors->first('genere'))
                            <ul class="errors">
                                <li>{{ $errors->first('genere') }}</li>
                            </ul>
                        @endif
                    </div>

                    <div>


                        <div class="container-dati_form">
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

                        <div class="container-dati_form">
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

                        <div class="container-dati_form">
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
                        <div class="container-dati_form">
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

                        <div class="container-dati_form">
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

                <div>
                    <div class="container-dati_form">
                        {{ Form::label('gestionePacchetti', 'Gestione pacchetti', ['class' => 'label-input']) }}
                        {{ Form::select('gestionePacchetti', ['No', 'Sì'], null, ['class' => 'input', 'id' => 'gestione_pacchetti']) }}
                    </div>
                </div>

                @isset($aziende)

                <div class="container-check-boxes-aziende">


                    {{ Form::label('', 'Aziende da gestire', ['class' => 'label-input']) }}

                    <div class="container-aziende-check">

                        @foreach($aziende as $azienda)

                            <label>
                                {{ Form::checkbox('aziende[]', $azienda->partita_iva, false, ['class' => 'input', 'id' => $azienda->nome]) }}
                                <span class="label-text">{{ $azienda->nome }} | {{ $azienda->partita_iva }}</span>
                            </label>

                        @endforeach

                    </div>


                </div>
                @endisset

                <div class="container-form_button">
                    {{ Form::submit('Modifica staff', ['class' => 'submit-button']) }}
                </div>


                {{ Form::close() }}
            </div>

        </div>
        @endisset



    <script>

        $(document).ready(function() {

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

            // script che viene eseguito solo dopo che il campo all'interno della select viene cambiato
            $('#staffUsername').change(function () {

                var utentiStaff = {!! $staff !!};

                // quando il valore cliccato sulla selection è diverso da '-' entra all'interno dell'if
                if ( $(this).val() !== '-') {

                    // prende l'offerta che si trova alla posizione i-esima
                    var staffSelezionato = utentiStaff[ $(this).val() ];

                    // popola tutti i campi della form
                    $('#nome').val(staffSelezionato.nome);
                    $('#cognome').val(staffSelezionato.cognome);
                    $('#email').val(staffSelezionato.email);
                    $('#username').val(staffSelezionato.username);
                    $('#genere').val(staffSelezionato.genere);
                    $('#eta').val(staffSelezionato.eta);
                    $('#telefono').val(staffSelezionato.telefono);
                    $('#via').val(staffSelezionato.via);
                    $('#numero_civico').val(staffSelezionato.numero_civico);
                    $('#citta').val(staffSelezionato.citta);
                    if(staffSelezionato.flagPacchetti == 0){
                        $('#gestione_pacchetti').val(0).change();
                    }
                    else{
                        $('#gestione_pacchetti').val(1).change();
                    }




                    // se invece si seleziona '-' tutti i campi vengono resettati
                }else{
                    $('#nome').val("");
                    $('#cognome').val("");
                    $('#email').val("");
                    $('#username').val("");
                    $('#genere').val("");
                    $('#eta').val("");
                    $('#telefono').val("");
                    $('#via').val("");
                    $('#numero_civico').val("");
                    $('#citta').val("");
                    $('#gestione_pacchetti').val(0).change();
                }

            });
        })

    </script>

@endsection
