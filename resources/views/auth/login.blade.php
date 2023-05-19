@extends('layouts.public')

@section('title', 'Login')

@section('content')
<div class="static">


    <div class="container-login">

        <h1>Login: Utilizza questa form per autenticarti al sito</h1>

        <div class="container-auth">
            {{ Form::open(array('route' => 'login', 'class' => 'contact-form')) }}

             <div  class="wrap-input">
                 <p> Se non hai già un account <a  href="{{ route('register') }}">registrati</a></p>
             </div>


             <div  class="container-dati-login">
                {{ Form::label('username', 'Nome Utente', ['class' => 'label-input']) }}
                {{ Form::text('username', '', ['class' => 'input','id' => 'username']) }}
                @if ($errors->first('username'))
                <ul class="errors">
                    @foreach ($errors->get('username') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

             <div  class="container-dati-login">
                {{ Form::label('password', 'Password', ['class' => 'label-input']) }}
                {{ Form::password('password', ['class' => 'input', 'id' => 'password']) }}
                @if ($errors->first('password'))
                <ul class="errors">
                    @foreach ($errors->get('password') as $message)
                    <li>{{ $message }}</li>
                    @endforeach
                </ul>
                @endif
            </div>

            <div class="container-autenticazione_button">
                {{ Form::submit('Login', ['class' => 'form-btn1']) }}
            </div>

            {{ Form::close() }}
        </div>
    </div>

</div>
@endsection
