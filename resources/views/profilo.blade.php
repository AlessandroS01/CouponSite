@extends('layouts.public')

@section('title', 'Profilo')

@section('content')

    @isset($user)
        <div class="container-logouser">
            <i class="fa fa-user" style="color: #363945;"></i>
        </div>

        <div class="container-profile">
            <div>

{{--                <img src="{{ asset('public/img/') }}" alt="Immagine Profilo">--}}

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

                <h3>Età:</h3>
                <p> {{$user->eta}}</p>
            </div>
        </div>
    @endisset

@endsection
