@extends('layouts.public')

@section('title', 'Catalogo aziende')

@section('content')

    <div class="container-barra_ricerca">

        <div class="barra-ricerca-aziende">

            {{ Form::open(['route' => 'catalogo offerte ricerca', 'method'=>'post', 'id' => 'ricerca_offerte', 'class' => 'form']) }}

            {{ Form::text('azienda', '', ['class' => 'ricerca-azienda', 'id' => 'queryAzienda', 'placeholder' => 'Azienda']) }}


            {{ Form::image( asset('img/search_icon.svg') , '', ['class' => "lente-ricerca", 'type' => 'submit']) }}

            {{ Form::close() }}

        </div>
    </div>

<section class="catalogo">
        <div class="catalogo-offerte">

            <div class="filters">
                <h2>Filtri</h2>

                <button class="accordion" id="first-filter" >Settore</button>
                <div class="accordion-panel">

                    <div id="settore" class="filter-items">

                        <label>
                            <input type="radio" name="settore" />
                            <span class="label-text">Informatica</span>
                        </label>



                        <label>
                            <input type="radio" name="settore" />
                            <span class="label-text">Abbigliamento</span>
                        </label>



                        <label>
                            <input type="radio" name="settore" />
                            <span class="label-text">Alimentari</span>
                        </label>

                    </div>

                </div>


            </div>

            <div class="container-offerte">
                @isset($aziende)
                    <div class="offerte">


                            @foreach ($aziende as $azienda)
                                <div class="card">

                                    <div class="img-container">
                                        <img src="{{ asset($azienda->logo) }}" alt="logo offerta" >
                                    </div>

                                    <div class="info">
                                        <h1>{{$azienda->nome}}</h1>
                                        <p>{{$azienda->descrizione}}</p>
                                    </div>

                                    <div class="button">
                                        <a href="{{ route('azienda', ['partita_iva' => $azienda->partita_iva]) }}">Visualizza</a>
                                    </div>

                                </div>
                            @endforeach
                    </div>
                <div class="paginator">
                    {{$aziende->links()}}
                </div>
                @endisset
            </div>

        </div>
    </section>
@endsection
