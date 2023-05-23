@extends('layouts.public')

@section('title', 'Pannello')

@section('content')


    <div class="container-gestione_titolo">
        <h1> Gestione staff</h1>
    </div>

    <div class="container-pannello">

        <div class="container-pannello_staff">

            <div class="container-gestione_pacchetto">
                <h2> Gestione Pacchetti</h2>

                <h4>+ Creazione pacchetto</h4>
                <h4>+ Modifica pacchetto</h4>
                <h4>+ Elimina pacchetto</h4>
            </div>

            <div class="container-gestione_offerte">
                <h2> Gestione Offerte</h2>

                <h4><a href="{{ route('creazione offerte') }}">+ Creazione offerta</a></h4>
                <h4><a href="#">+ Modifica offerta</a></h4>
                <h4><a href="#">+ Elimina offerta</a></h4>
            </div>



        </div>
    </div>


@endsection
