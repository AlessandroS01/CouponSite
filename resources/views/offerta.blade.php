@extends('layouts.public')

@section('title', 'Offerta')

@section('link')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('css/offerta.css') }}" >

@endsection

@section('content')

    @isset($gestoreOfferte, $offerta, $azienda)
        <div class="container-offerta_completa">

            <div>
                <h1> {{ ucfirst($offerta->categoria) }} </h1>
                <img src="{{ asset($gestoreOfferte->getLogoAziendaByOfferta($offerta)) }}">
            </div>


            <div class="container-dettagli-offerta">
                <h1> {{ $offerta->oggetto_offerta }}</h1>
                <!-- l'href va puntato alla pagina dell'azienda -->
                <a class="ancora_azienda"href=" {{ route('azienda', ['partita_iva' => $azienda->partita_iva] ) }}">
                    {{ $azienda->nome }}
                </a>

                <div class="container-prezzo_offerta">
                    <span class="span-offerta"> Offerta </span>
                    <div class="container-prezzo_scontato">
                        <h2 class="sconto_offerta"> -{{ $offerta->percentuale_sconto }}% </h2>

                        <h2 class="prezzo_scontato"> &#8364<span>{{ $gestoreOfferte->getPrezzoScontato($offerta) }}</span> </h2>
                    </div>

                    <h6> Prezzo iniziale: &#8364<span>{{ $offerta->prezzo_pieno }}</span></h6>
                </div>
                <hr>
                <!-- Descrizione dell'offerta -->
                <p class="descrizione-offerta"> {{ $offerta->descrizione }}

            </div>

            <div class="container-acquisizione_offerta">

                <!-- Modalità di fruizione dell'offerta -->
                <p class="modalita-fruizione_offerta"> Modalità di fruizione: <br>{{ $offerta->modalita_fruizione }} </p>
                <p class="data-scadenza_offerta"> Data di scadenza: <br>{{ $offerta->data_scadenza }} </p>

                <h3> Prezzo scontato: <br>&#8364<span>{{ $gestoreOfferte->getPrezzoScontato($offerta) }}</span></h3>


                @auth
                    <div class="container-form-acquisizione">

                        {{ Form::open(['route' => 'generazione coupon', 'method' => 'post', 'id' => 'ottenimento-coupon', 'class' => 'form']) }}

                        <div class="bottone-acquisizione">
                            {{ Form::submit('Ottieni', ['class' => 'btn']) }}
                        </div>


                        {{ Form::hidden('codiceOfferta',  $offerta->codice  ) }}

                        {{ Form::close() }}

                    </div>
                @endauth

                @guest


                    <div class="bottone-acquisizione_guest">
                        <a href="{{ route('login') }}">ottieni</a>
                    </div>

                @endguest

            </div>



        </div>
    @endif()

@endsection
