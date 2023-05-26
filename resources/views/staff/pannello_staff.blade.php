@extends('layouts.public')

@section('title', 'Pannello')

@section('content')


    <div class="container-gestione_titolo">
        <h1> Gestione staff</h1>
    </div>

    <div class="container-pannello">

        @can('isStaffPacchetti')

            <div class="container-pannello_staff">


                <div class="container-gestione_pacchetto">
                    <h2> Gestione Pacchetti</h2>

                    <h4><a href="#">+ Creazione pacchetto</a></h4>
                    <h4><a href="#">+ Modifica pacchetto</a></h4>
                    <h4><a href="#">+ Elimina pacchetto</a></h4>
                </div>


                <div class="container-gestione_offerte">
                    <h2> Gestione Offerte</h2>

                    <h4><a href="{{ route('creazione offerta') }}">+ Creazione offerta</a></h4>
                    <h4><a href="{{ route('modifica offerta') }}">+ Modifica offerta</a></h4>
                    <h4><a href="{{ route('eliminazione offerta') }}">+ Elimina offerta</a></h4>
                </div>
            </div>

        @else

            <div class="container-pannello_staff-noPacchetti">

                <div class="container-gestione_offerte">
                    <h2> Gestione Offerte</h2>

                    <h4><a href="{{ route('creazione offerta') }}">+ Creazione offerta</a></h4>
                    <h4><a href="{{ route('modifica offerta') }}">+ Modifica offerta</a></h4>
                    <h4><a href="{{ route('eliminazione offerta') }}">+ Elimina offerta</a></h4>
                </div>
            </div>

        @endcan





    </div>


@endsection
