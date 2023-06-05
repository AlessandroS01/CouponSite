@extends('layouts.public')

@section('title', 'Catalogo aziende')

@section('link')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('css/catalogo.css') }}" >

@endsection

@section('content')

    <div class="container-barra_ricerca">

        <div class="barra-ricerca-aziende">

            {{ Form::open(['route' => 'catalogo aziende ricerca', 'method'=>'get', 'id' => 'ricerca_offerte', 'class' => 'form']) }}

                {{ Form::text('azienda', '', ['class' => 'ricerca-azienda', 'id' => 'queryAzienda', 'placeholder' => 'Azienda']) }}


                {{ Form::image( asset('img/search_icon.svg') , '', ['class' => "lente-ricerca", 'type' => 'submit']) }}

            {{ Form::close() }}

        </div>
    </div>

<section class="catalogo">
        <div class="catalogo-offerte">

            <div class="filters">
                <h2>Sfoglia le aziende</h2>
                <h3>Clicca visualizza per vedere i dettagli dell'azienda</h3>




            </div>

            <div class="container-offerte">

                @yield('ricercaAziende')

            </div>

        </div>
    </section>
@endsection
