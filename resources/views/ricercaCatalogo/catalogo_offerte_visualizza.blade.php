@extends('catalogo_offerte')


@section('ricercaOfferte')

    <div class="offerte">

        @isset($offerte, $gestioneOfferte)

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
                        <a href="{{ route('offerta', ['offertaId' => $offerta->codice] ) }}">ottieni</a>
                    </div>
                    <div class="badge">
                        <p>{{ $offerta->percentuale_sconto }}%</p>
                    </div>
                </div>

            @endforeach

        @endisset

    </div>

@endsection
