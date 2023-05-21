@extends('layouts.public')

@section('title', 'Catalogo offerte')

@section('content')

    <div class="container-barra_ricerca">

        <div class="barra-ricerca">

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

                <button class="accordion" id="first-filter">Categoria</button>
                <div class="accordion-panel">

                    <div id="categoria" class="filter-items">

                        {{ Form::open(['route' => 'catalogo offerte ricerca', 'method' => 'get', 'id' => 'ricerca_offerte', 'class' => 'form']) }}

                            <label>
                                {{ Form::checkBox('categoriaInformatica', 'Informatica') }}
                                <span class="label-text">Informatica</span>
                            </label>

                            <label>
                                {{ Form::checkBox('categoriaAbbigliamento', 'Abbigliamento') }}
                                <span class="label-text">Abbigliamento</span>
                            </label>

                            <label>
                                {{ Form::checkBox('categoriaAlimentari', 'Alimentari') }}
                                <span class="label-text">Alimentari</span>
                            </label>

                        {{ Form::submit('Submit') }}

                        {{ Form::close() }}

                    </div>

                </div>

                <button class="accordion " id="second-filter">% sconto</button>
                <div class="accordion-panel">

                    <div id="tipologia" class="filter-items">

                        <label>
                            <input type="radio" name="tipologia" />
                            <span class="label-text">fino al 10%</span>
                        </label>



                        <label>
                            <input type="radio" name="tipologia" />
                            <span class="label-text">dal 10% al 20%</span>
                        </label>



                        <label>
                            <input type="radio" name="tipologia" />
                            <span class="label-text">sopra 20%</span>
                        </label>

                    </div>


                </div>

            </div>

            <div class="container-offerte">

                        @yield('ricercaOfferte')

            </div>

        </div>

    </section>



@endsection
