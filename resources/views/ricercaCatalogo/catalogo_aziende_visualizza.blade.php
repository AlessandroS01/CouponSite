@extends('catalogo_aziende')


@section('ricercaAziende')

    @isset($aziende)
        <div class="offerte">


            @foreach ($aziende as $azienda)
                <div class="card">

                    <div class="img-container">
                        <img src="{{ asset($azienda->logo) }}" alt="logo offerta" >
                    </div>

                    <div class="info">
                        <h1>{{ ucfirst($azienda->nome) }}</h1>
                        <p>{{ ucfirst($azienda->descrizione) }}</p>
                    </div>

                    <div class="button">
                        <!--Viene settata un ancora che punta alla rotta azienda alla quale viene passato
                        la partita iva dell'offerta selezionata-->
                        <a href="{{ route('azienda', ['partita_iva' => $azienda->partita_iva]) }}">Visualizza</a>
                    </div>

                </div>
            @endforeach

        </div>

        <div class="paginator">
            {{$aziende->links()}}
        </div>

    @endisset

@endsection
