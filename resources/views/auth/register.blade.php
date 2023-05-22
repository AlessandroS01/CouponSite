@extends('layouts.public')

@section('title', 'Registrazione')

@section('content')
<div class="container-register">
    <h1>Registrazione</h1>
    <p>Utilizza questa form per registrarti al sito</p>
    <div class="form-registrazione">
        <div class="container-form-register">
            <div>
                {{ Form::open(array('route' => 'register', 'class' => 'contact-form', 'method' => 'POST')) }}

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
@endsection
