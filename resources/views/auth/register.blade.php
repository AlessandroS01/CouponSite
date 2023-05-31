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
                    {{ Form::label('password_confirmation', 'Conferma password', ['class' => 'label-input']) }}
                    {{ Form::password('password_confirmation', ['class' => 'input', 'id' => 'password_confirmation']) }}
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
@endsection

