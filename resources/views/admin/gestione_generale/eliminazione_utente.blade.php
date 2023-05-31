@extends('layouts.public')

@section('title', 'Elimina utente')

@section('content')

    <div class="container-titolo_form">
    <h1> Elimina utente</h1>
    </div>

    @isset($utente)
    <div class="container-form">
        <div class="form">

            {{ Form::open(array('route' => 'eliminazione utente', 'class' => 'contact-form', 'method' => 'POST')) }}
            @csrf
            {{ Form::hidden('utenteId', null, ['id' => 'utenteId']) }}

            <div>
                @isset($usernameUtentiRegistrati)
                    <div  class="container-dati_form">
                        {{ Form::label('utente', 'utente', ['class' => 'label-input']) }}

                        {{ Form::select('utente', [ '-' => '-'] + $usernameUtentiRegistrati, null, ['class' => 'input', 'id' => 'utenteUsername', 'readonly' => 'readonly']) }}
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



            <div class="container-form_button">
                {{ Form::submit('Elimina utente', ['class' => 'submit-button']) }}
            </div>


            {{ Form::close() }}
        </div>

    </div>
    @endisset



@endsection


@section('script')
    <script>
        var utenti = {!! $utente !!};
    </script>

    <script src="{{ asset('js/EliminazioneUtente.js') }}"></script>
@endsection
