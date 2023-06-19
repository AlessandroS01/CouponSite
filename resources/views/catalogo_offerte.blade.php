@extends('layouts.public')

@section('title', 'Catalogo offerte')

@section('link')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('css/catalogo.css') }}" >

@endsection

@section('content')

    <div class="container-barra_ricerca">

        <div class="barra-ricerca">

            <!-- Apertura del form con il metodo GET e la route 'catalogo offerte ricerca' -->
            {{ Form::open(['route' => 'catalogo offerte ricerca', 'method'=>'get', 'id' => 'ricerca_offerte', 'class' => 'form']) }}

            <!-- Input per la ricerca per nome dell'offerta -->
            {{ Form::text('offerta', '', ['class' => 'ricerca-offerta', 'id' => 'queryOfferta', 'placeholder' => 'Offerta']) }}

            <!-- Input per la ricerca per azienda -->
            {{ Form::text('azienda', '', ['class' => 'ricerca-azienda', 'id' => 'queryAzienda', 'placeholder' => 'Azienda']) }}

            <!-- Immagine come pulsante di invio del form -->
            {{ Form::image( asset('img/search_icon.svg') , '', ['class' => "lente-ricerca", 'type' => 'submit']) }}

            {{ Form::close() }}

        </div>
    </div>


    <section class="catalogo">
        <div class="catalogo-offerte">

            <div class="filters">
                <h2>Sfoglia le offerte</h2>
                <h3>Clicca ottieni per riscattare l'offerta</h3>
            </div>

            <div class="container-offerte">

                <!-- Impostiamo una sezione vuota che verrà riempita tramite la select nella
                 vista catalogo_offerte_visualizza-->
                @yield('ricercaOfferte')

            </div>

        </div>

    </section>



@endsection
