<!-- Viene estesa la vista catalogo_offerte.blade.php -->
@extends('catalogo_offerte')

@section('ricercaOfferte')

    <div class="offerte">

        <!-- Verifica che entrambe le variabili $offerte e $gestioneOfferte sono definite e non nulle -->
        @isset($offerte, $gestioneOfferte)

            <!-- per ogni offerta vengono settate le card che contengono i dati di tutte le offerte -->
            @foreach ($offerte as $offerta)

                <div class="card">
                    <div class="img-container">
                        <img src="{{ asset($gestioneOfferte->getLogoAziendaByOfferta($offerta)) }}" alt="logo offerta">
                    </div>
                    <div class="info">
                        <h1>{{ $offerta->oggetto_offerta }}</h1>
                        <p>{{ $offerta->descrizione }}</p>
                    </div>
                    <div class="button">
                        <!--Viene settata un ancora che punta alla rotta offerta alla quale viene passato
                        l'id dell'offerta-->
                        <a href="{{ route('offerta', ['offertaId' => $offerta->codice] ) }}">ottieni</a>
                    </div>
                    <div class="badge">
                        <p>{{ $offerta->percentuale_sconto }}%</p>
                    </div>
                </div>

            @endforeach

    </div>

    <div class="paginator">
        {{ $offerte->links() }}
    </div>
    @endisset

@endsection
