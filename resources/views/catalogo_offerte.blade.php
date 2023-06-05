@extends('layouts.public')

@section('title', 'Catalogo offerte')

@section('link')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('css/catalogo.css') }}" >

@endsection

@section('content')

    <div class="container-barra_ricerca">

        <div class="

        barra-ricerca">

            {{ Form::open(['route' => 'catalogo offerte ricerca', 'method'=>'get', 'id' => 'ricerca_offerte', 'class' => 'form']) }}


            {{ Form::text('offerta', '', ['class' => 'ricerca-offerta', 'id' => 'queryOfferta', 'placeholder' => 'Offerta']) }}

            {{ Form::text('azienda', '', ['class' => 'ricerca-azienda', 'id' => 'queryAzienda', 'placeholder' => 'Azienda']) }}


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

                @yield('ricercaOfferte')

            </div>

        </div>

    </section>



@endsection
