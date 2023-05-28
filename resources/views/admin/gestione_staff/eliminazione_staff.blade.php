@extends('layouts.public')

@section('title', 'Elimina staff')

@section('content')


    <div class="container-offerta_dettagli">
        <h1> Elimina staff</h1>
    </div>

    @isset($staff)
        <div class="container-form">
            <div class="form">

                {{ Form::open(array('route' => 'eliminazione staff', 'class' => 'contact-form', 'method' => 'POST')) }}

                {{ Form::hidden('staffId', null, ['id' => 'staffId']) }}

                <div>
                    @isset($usernameUtentiStaff)
                        <div  class="container-dati_form">
                            {{ Form::label('staff', 'Staff', ['class' => 'label-input']) }}

                            {{ Form::select('staff', [ '-' => '-'] + $usernameUtentiStaff, null, ['class' => 'input', 'id' => 'staffUsername', 'readonly' => 'readonly']) }}
                        </div>
                    @endisset
                </div>

                <div class="container-form-gestione">
                    <div>


                        <div  class="container-dati_form">
                            {{ Form::label('nome', 'Nome', ['class' => 'label-input']) }}
                            {{ Form::text('nome', '', ['class' => 'input', 'id' => 'nome', 'readonly' => 'readonly']) }}

                        </div>


                        <div  class="container-dati_form">
                            {{ Form::label('cognome', 'Cognome', ['class' => 'label-input']) }}
                            {{ Form::text('cognome', '', ['class' => 'input', 'id' => 'cognome', 'readonly' => 'readonly']) }}

                        </div>


                        <div  class="container-dati_form">
                            {{ Form::label('email', 'Email', ['class' => 'label-input']) }}
                            {{ Form::text('email', '', ['class' => 'input','id' => 'email', 'readonly' => 'readonly']) }}

                        </div>


                        <div  class="container-dati_form">
                            {{ Form::label('username', 'Username', ['class' => 'label-input']) }}
                            {{ Form::text('username', '', ['class' => 'input','id' => 'username', 'readonly' => 'readonly']) }}

                        </div>


                        <div class="container-dati_form">
                            {{ Form::label('genere', 'Genere', ['class' => 'label-input']) }}
                            {{ Form::select('genere', ['-'=> '-', 'M' => 'M', 'F' => 'F'], null, ['class' => 'input', 'id' => 'genere', 'disabled' => 'disabled']) }}

                        </div>

                    </div>

                    <div>


                        <div class="container-dati_form">
                            {{ Form::label('eta', 'Età', ['class' => 'label-input']) }}
                            {{ Form::text('eta', '', ['class' => 'input', 'id' => 'eta', 'readonly' => 'readonly']) }}

                        </div>


                        <div class="container-dati_form">
                            {{ Form::label('telefono', 'Telefono', ['class' => 'label-input']) }}
                            {{ Form::text('telefono', '', ['class' => 'input', 'id' => 'telefono', 'readonly' => 'readonly']) }}
                        </div>


                        <div class="container-dati_form">
                            {{ Form::label('via', 'Via', ['class' => 'label-input']) }}
                            {{ Form::text('via', '', ['class' => 'input', 'id' => 'via', 'readonly' => 'readonly']) }}

                        </div>


                        <div class="container-dati_form">
                            {{ Form::label('numero_civico', 'Numero Civico', ['class' => 'label-input']) }}
                            {{ Form::text('numero_civico', '', ['class' => 'input', 'id' => 'numero_civico', 'readonly' => 'readonly']) }}

                        </div>


                        <div class="container-dati_form">
                            {{ Form::label('citta', 'Città', ['class' => 'label-input']) }}
                            {{ Form::text('citta', '', ['class' => 'input', 'id' => 'citta', 'readonly' => 'readonly']) }}

                        </div>

                    </div>
                </div>

                <div>
                    <div class="container-dati_form">
                        {{ Form::label('gestionePacchetti', 'Gestione pacchetti', ['class' => 'label-input']) }}
                        {{ Form::select('gestionePacchetti', ['No', 'Sì'], null, ['class' => 'input', 'id' => 'gestione_pacchetti', 'disabled' => 'disabled']) }}
                    </div>
                </div>


                <div class="container-form_button">
                    {{ Form::submit('Elimina staff', ['class' => 'submit-button']) }}
                </div>


                {{ Form::close() }}
            </div>

        </div>
    @endisset

    <script>

        $(document).ready(function() {

            // script che viene eseguito solo dopo che il campo all'interno della select viene cambiato
            $('#staffUsername').change(function () {

                var utentiStaff = {!! $staff !!};

                // quando il valore cliccato sulla selection è diverso da '-' entra all'interno dell'if
                if ( $(this).val() !== '-') {

                    // prende l'offerta che si trova alla posizione i-esima
                    var staffSelezionato = utentiStaff[ $(this).val() ];

                    // popola tutti i campi della form
                    $('#staffId').val(staffSelezionato.id);
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
                    $('#staffId').val("");
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