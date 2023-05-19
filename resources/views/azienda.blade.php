@extends('layouts.public')

@section('title', 'Azienda')

@section('content')

    @isset($azienda)
        <div class="container-azienda_completa">

            <div class="container-header_azienda">
                <img class="logo_azienda"src={{ asset( $azienda->logo )}}>
                <div class="container-informazioni_azienda">
                    <p>{{ $azienda->nome }}</p>
                    <p class="contatti-azienda"> Contatti azienda</p>
                    <div class="container-contatti_azienda">
                        <p><i class="fa fa-phone"></i>+39 327-8124810</p>
                        <p><i class="fa fa-envelope"></i>coupon-fantastici@gmail.com</p>
                        <p><i class="fa fa-map-marker"></i>{{ $azienda->localita }}</p>
                        <p><i class="fas fa-building"></i>{{ $azienda->descrizione }}</p>
                    </div>
                </div>
            </div>
        </div>



    @isset($offerte)
        <div class="container-offerte_azienda">
            <!-- il grid serve a posizionare al centro della cella
            le varie card-->
            @foreach($offerte as $offerta)
                <div class="container-card">

                    <div class="card">

                        <div class="img-container">
                            <img src='{{ asset( $azienda->logo) }}' alt="logo offerta" >
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

                </div>
            @endforeach
        </div>
    @endisset
    @endisset

@endsection
