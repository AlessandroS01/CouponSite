@extends('layouts.public')

@section('title', 'Profilo')

@section('content')

    @isset($user)
    <div class="container-profile">
        <div>
            <h3>Username:</h3>
            <p>{{$user->username}}</p>

            <h3>Email:</h3>
            <p>{{$user->email}}</p>

            <h3>Telefono:</h3>
            <p>{{$user->telefono}}</p>

            <h3>Indirizzo:</h3>
            <p>{{$user->citta}}, {{$user->via}} {{$user->numero_civico}}</p>



        </div>

        <div>

            <h3>Nome:</h3>
            <p>{{$user->nome}}</p>

            <h3>Cognome:</h3>
            <p>{{$user->cognome}}</p>

            <h3>Genere:</h3>
            <p> {{$user->genere}}</p>

            <h3>Genere:</h3>
            <p> {{$user->eta}}</p>

        </div>
    </div>
    @endisset

@endsection
