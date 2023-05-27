@extends('layouts.public')

@section('title', 'Pannello')

@section('content')

    <div class="container-gestione_titolo">
        <h1> Gestione admin</h1>
    </div>

    <div class="container-pannello_ad">

        <div class="container-pannello_admin">


            <div class="container-gestione_aziende">
                <h2> Gestione Aziende</h2>

                <h4><a href="{{ route('aggiunta azienda') }}">+ Creazione azienda</a></h4>
                <h4><a href="#">+ Modifica azienda</a></h4>
                <h4><a href="#">+ Elimina azienda</a></h4>
            </div>


            <div class="container-gestione_staff">
                <h2> Gestione Staff</h2>

                <h4><a href="{{ route('aggiunta staff') }}">+ Aggiunta staff</a></h4>
                <h4><a href="#">+ Modifica staff</a></h4>
                <h4><a href="#">+ Eliminazione staff</a></h4>
            </div>

            <div class="container-gestione_admin">
                <h2> Gestione Generale</h2>

                <h4><a href="#">+ Modifica FAQs</a></h4>
                <h4><a href="#">+ Visualizzazione statistiche</a></h4>
                <h4><a href="#">+ Eliminazione cliente</a></h4>
            </div>
        </div>

    </div>


@endsection
