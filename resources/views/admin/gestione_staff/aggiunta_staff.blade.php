@extends('layouts.public')

@section('title', 'Aggiunta staff')

@section('content')


        <div class="container-titolo_form">
            <h1> Aggiunta staff</h1>
        </div>

        <div class="container-form">
            <div class="form">
                <div class="container-form-gestione">
                    <div>
                        <!--Al submit della form si attiva la rotta aggiunta staff -->
                        {{ Form::open(array('route' => 'aggiunta staff', 'class' => 'contact-form', 'method' => 'POST')) }}
                        @csrf
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
                            {{ Form::text('username', '', ['class' => 'input','id' => 'username']) }}

                        </div>
                        @if ($errors->first('username'))
                            <ul class="errors">
                                @foreach ($errors->get('username') as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <div  class="container-dati_form">
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

                        <div  class="container-dati_form">
                            {{ Form::label('password-confirm', 'Conferma password', ['class' => 'label-input']) }}
                            {{ Form::password('password_confirmation', ['class' => 'input', 'id' => 'password-confirm']) }}
                        </div>
                    </div>

                    <div>
                        <div class="container-dati_form">
                            {{ Form::label('genere', 'Genere', ['class' => 'label-input']) }}
                            {{ Form::select('genere', ['M' => 'M', 'F' => 'F'], null, ['class' => 'input', 'id' => 'genere']) }}

                        </div>
                        @if ($errors->first('genere'))
                            <ul class="errors">
                                <li>{{ $errors->first('genere') }}</li>
                            </ul>
                        @endif

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
                        <!--Andiamo a definire tramite la select se l'utente staff può gestire i pacchetti -->
                        {{ Form::select('gestionePacchetti', ['No', 'Sì'], null, ['class' => 'input', 'id' => 'gestione_pacchetti']) }}
                    </div>
                </div>


                @isset($aziende)

                <div class="container-check-boxes-aziende">


                    {{ Form::label('', 'Aziende da gestire', ['class' => 'label-input']) }}

                    <div class="container-aziende-check">

                        <!--Per ogni azienda andiamo a definire una check box nella quale specifico la
                         partita iva dell'azienda e il nome dell'azienda-->
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
                    {{ Form::submit('Aggiungi staff', ['class' => 'submit-button']) }}
                </div>


                {{ Form::close() }}
            </div>

        </div>




@endsection


@section('script')
    <script src="{{ asset('js/AggiuntaStaffCheckboxes.js') }}"></script>
@endsection
