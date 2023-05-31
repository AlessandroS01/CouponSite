@extends('layouts.public')

@section('title', 'Elimina staff')

@section('content')


    <div class="container-titolo_form">
        <h1> Elimina staff</h1>
    </div>

    @isset($staff)
        <div class="container-form">
            <div class="form">

                    {{ Form::open(array('route' => 'eliminazione staff', 'class' => 'contact-form', 'method' => 'POST')) }}
                @csrf
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



    </script>

@endsection

@section('script')
    <script>
        var utentiStaff = {!! $staff !!};
    </script>

    <script src="{{ asset('js/EliminazioneStaff.js') }}"></script>
@endsection

