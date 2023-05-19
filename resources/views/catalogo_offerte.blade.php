@extends('layouts.public')

@section('title', 'Catalogo offerte')

@section('content')

    <div class="container-barra_ricerca">
        <div class="barra-ricerca">
            <input class="ricerca-prodotto" type="search" name="prodotto" placeholder="Prodotto">
            <input class="ricerca-azienda" type="search" name="azienda" placeholder="Azienda">
            <a href="{{ route('catalogo_offerte_search', ['prodotto' => request('prodotto'), 'azienda' => request('azienda')]) }}">
                <img class="lente-ricerca" src="img/search_icon.svg">
            </a>
        </div>
    </div>


    <section class="catalogo">
        <div class="catalogo-offerte">

            <div class="filters">
                <h2>Filtri</h2>

                <button class="accordion" id="first-filter">Categoria</button>
                <div class="accordion-panel">

                    <div id="categoria" class="filter-items">

                        <label>
                            <input type="radio" name="categoria" />
                            <span class="label-text">Informatica</span>
                        </label>



                        <label>
                            <input type="radio" name="categoria" />
                            <span class="label-text">Abbigliamento</span>
                        </label>



                        <label>
                            <input type="radio" name="categoria" />
                            <span class="label-text">Alimentari</span>
                        </label>

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
                <div class="offerte">

                    <div class="card">

                        <div class="img-container">
                            <img src="img/amazon.png" alt="logo offerta" >
                        </div>

                        <div class="info">
                            <h1>Offerta</h1>
                            <p>Descrizione offerta</p>
                        </div>

                        <div class="button">
                            <a href="{{ route('offerta') }}">ottieni</a>
                        </div>

                        <div class="badge">
                            <p>50%</p>
                        </div>


                    </div>

                    <div class="card">

                        <div class="img-container">
                            <img src="img/amazon.png" alt="logo offerta" >
                        </div>

                        <div class="info">
                            <h1>Offerta</h1>
                            <p>Descrizione offerta</p>
                        </div>

                        <div class="button">
                            <a href="{{ route('offerta') }}">ottieni</a>
                        </div>

                        <div class="badge">
                            <p>50%</p>
                        </div>


                    </div>

                    <div class="card">

                        <div class="img-container">
                            <img src="img/amazon.png" alt="logo offerta" >
                        </div>

                        <div class="info">
                            <h1>Offerta</h1>
                            <p>Descrizione offerta</p>
                        </div>

                        <div class="button">
                            <a href="{{ route('offerta') }}">ottieni</a>
                        </div>

                        <div class="badge">
                            <p>50%</p>
                        </div>


                    </div>

                    <div class="card">

                        <div class="img-container">
                            <img src="img/amazon.png" alt="logo offerta" >
                        </div>

                        <div class="info">
                            <h1>Offerta</h1>
                            <p>Descrizione offerta</p>
                        </div>

                        <div class="button">
                            <a href="{{ route('offerta') }}">ottieni</a>
                        </div>

                        <div class="badge">
                            <p>50%</p>
                        </div>


                    </div>

                </div>


            </div>

        </div>
    </section>



@endsection
