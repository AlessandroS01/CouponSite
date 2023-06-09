@extends('layouts.public')


@section('link')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pannelli_gestione.css') }}" >

@endsection

@section('title', 'Pannello')

    @section('content')

        <div class="container-gestione_titolo">
            <h1> Gestione admin</h1>
        </div>

        <div class="container-pannello_ad">
            <div class="container-gestione_aziende grid-item">
                <h2>Gestione Aziende</h2>
                <h4><a href="{{ route('aggiunta azienda') }}">+ Creazione azienda</a></h4>
                <h4><a href="{{ route('modifica azienda') }}">+ Modifica azienda</a></h4>
                <h4><a href="{{ route('eliminazione azienda') }}">+ Elimina azienda</a></h4>
            </div>

            <div class="container-gestione_staff grid-item">
                <h2>Gestione Staff</h2>
                <h4><a href="{{ route('aggiunta staff') }}">+ Aggiunta staff</a></h4>
                <h4><a href="{{ route('modifica staff') }}">+ Modifica staff</a></h4>
                <h4><a href="{{ route('eliminazione staff') }}">+ Eliminazione staff</a></h4>
            </div>

            <div class="container-gestione_admin grid-item">
                <h2>Gestione Generale</h2>
                <h4><a href="{{ route('visualizza statistiche') }}">+ Visualizzazione statistiche</a></h4>
                <h4><a href="{{ route('eliminazione utente') }}">+ Eliminazione cliente</a></h4>
            </div>

            <div class="container-gestione_admin grid-item">
                <h2>Gestione FAQ</h2>
                <h4><a href="{{ route('aggiunta FAQ') }}">+ Aggiungi FAQ</a></h4>
                <h4><a href="{{route('modifica FAQ')}}">+ Modifica FAQ</a></h4>
                <h4><a href="{{route('elimina FAQ')}}">+ Elimina FAQ</a></h4>
            </div>


        </div>


@endsection
