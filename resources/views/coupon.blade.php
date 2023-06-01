<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/coupon.css') }}" >

    <title>@yield('title', 'Coupon')</title>
</head>

    <body>

        <div class="barra-superiore_coupon">

            <a href="{{ route('home') }}"> <img src="{{ asset('img/logo.png') }}" title="Home" alt="site logo"> </a>

        </div>

        @isset($validita_promozione)
            <div class="container-errore_generazione">
                <h1> L'offerta richiesta è scaduta</h1>
            </div>
        @endisset

        @isset($offertaSelezionata, $gestoreOfferte, $coupon, $user, $flagCoupon)

            @if($flagCoupon)

                <div class="container">

                    <div class="container-coupon_string">

                        <h1 class="coupon_string"> Codice del coupon : {{ $coupon->codice_coupon }} </h1>

                        <div class="container-dati_utente">

                            <p> Nome cliente: {{ $user->nome }} </p>
                            <p> Cognome cliente: {{ $user->cognome }} </p>

                        </div>

                    </div>


                    <div class="container-offerta">

                        <div class="container-logo_azienda">
                            <img src="{{asset( $gestoreOfferte->getLogoAziendaByOfferta($offertaSelezionata))}}">
                        </div>

                        <div class="container-offerta_dati">

                            <h2> {{ $offertaSelezionata->oggetto_offerta }}</h2>
                            <h3> Prezzo coupon: {{ $gestoreOfferte->getPrezzoScontato($offertaSelezionata) }}&#8364</h3>
                            <h5> {{ $offertaSelezionata-> descrizione }}</h5>

                        </div>

                        <div class="container-modalita_uso">

                            <h4> Modalità di fruizione: {{ $offertaSelezionata->modalita_fruizione }} </h4>
                            <h4> Luogo di fruizione: {{ $offertaSelezionata->luogo_fruizione }}</h4>

                        </div>

                    </div>

                    <div class="container-data_scadenza">
                        <h5> Da usufruire prima del {{ $offertaSelezionata->data_scadenza }} </h5>
                    </div>

                </div>

            @else

                <div class="container">

                    <div class="container-coupon_string">

                        <h1> Il coupon risulta già erogato. </h1>

                        <h4 class="coupon_string"> Codice del coupon : {{ $coupon->codice_coupon }} </h4>

                        <div class="container-dati_utente">

                            <p> Nome cliente: {{ $user->nome }}</p>
                            <p> Cognome cliente: {{ $user->cognome }}</p>

                        </div>

                    </div>


                    <div class="container-offerta">

                        <div class="container-logo_azienda">
                            <img src="{{asset( $gestoreOfferte->getLogoAziendaByOfferta($offertaSelezionata))}}">
                        </div>

                        <div class="container-offerta_dati">

                            <h2> {{ $offertaSelezionata->oggetto_offerta }}</h2>
                            <h3> Prezzo coupon: {{ $gestoreOfferte->getPrezzoScontato($offertaSelezionata) }}&#8364</h3>
                            <h5> {{ $offertaSelezionata-> descrizione }}</h5>

                        </div>

                        <div class="container-modalita_uso">

                            <h4> Modalità di fruizione: {{ $offertaSelezionata->modalita_fruizione }} </h4>
                            <h4> Luogo di fruizione: {{ $offertaSelezionata->luogo_fruizione }}</h4>

                        </div>

                    </div>

                    <div class="container-data_scadenza">
                        <h5> Da usufruire prima del {{ $offertaSelezionata->data_scadenza }} </h5>
                    </div>
                </div>
            @endif


        @endisset



    </body>
</html>
