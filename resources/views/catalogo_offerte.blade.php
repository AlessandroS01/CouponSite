@extends('layouts.public')

@section('title', 'Catalogo offerte')

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
                <h2>Filtri</h2>

                <button class="accordion" id="first-filter">% sconto</button>

                <div class="accordion-panel">

                    <div id="scontistica" class="filter-items">
                        {{ Form::open(['route' => 'catalogo offerte ricerca', 'method' => 'get', 'id' => 'ricerca_offerte', 'class' => 'form']) }}

                        <label>
                            {{ Form::checkbox('sconto', 'sotto_10', isset($_GET['sconto']) && $_GET['sconto'] === 'sotto_10', ['id' => 'checkbox_sotto_10']) }}
                            <span class="label-text">fino al 10%</span>
                        </label>

                        <label>
                            {{ Form::checkbox('sconto', 'tra_10_e_20', isset($_GET['sconto']) && $_GET['sconto'] === 'tra_10_e_20', ['id' => 'checkbox_tra_10_e_20']) }}
                            <span class="label-text">dal 10% al 20%</span>
                        </label>

                        <label>
                            {{ Form::checkbox('sconto', 'sopra_20', isset($_GET['sconto']) && $_GET['sconto'] === 'sopra_20', ['id' => 'checkbox_sopra_20']) }}
                            <span class="label-text">sopra 20%</span>
                        </label>

                        {{ Form::submit('Applica', ['class' => 'submit_scontistica']) }}

                        {{ Form::close() }}
                    </div>

                </div>

            </div>

            <div class="container-offerte">

                @yield('ricercaOfferte')

            </div>

        </div>

    </section>



@endsection
