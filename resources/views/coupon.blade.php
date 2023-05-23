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

        @isset($offertaSelezionata, $gestoreOfferte, $coupon, $flagCoupon)

            @if($flagCoupon)

                <div class="container">

                    <div class="container-coupon_string">

                        <h1> Codice del coupon : {{ $coupon->codice_coupon }} </h1>

                    </div>


                    <div class="container-offerta">
                        <div class="container-logo_azienda">
                            <img src="{{asset( $gestoreOfferte->getLogoAziendaByOfferta($offertaSelezionata))}}">
                        </div>

                        <div class="container-offerta_dati">
                            <p>{{ $offertaSelezionata->modalita_fruizione }}</p>
                        </div>

                        <div class="container-modalita_uso">
                            <p>{{ $offertaSelezionata->modalita_fruizione }}</p>
                            <p>{{ $offertaSelezionata->luogo_fruizione }}</p>
                        </div>

                    </div>
                </div>

            @else

                <div class="container">

                    <div class="container-coupon_string">

                        <h1> Il coupon risulta già erogato. </h1>

                        <h4> Codice del coupon : {{ $coupon->codice_coupon }} </h4>

                    </div>


                    <div class="container-offerta">
                        <div class="container-logo_azienda">
                            <img src="{{asset( $gestoreOfferte->getLogoAziendaByOfferta($offertaSelezionata))}}">
                        </div>

                        <div class="container-offerta_dati">
                            <p>{{ $offertaSelezionata->modalita_fruizione }}</p>
                        </div>

                        <div class="container-modalita_uso">
                            <p>{{ $offertaSelezionata->modalita_fruizione }}</p>
                            <p>{{ $offertaSelezionata->luogo_fruizione }}</p>
                        </div>

                    </div>
                </div>
            @endif


        @endisset



    </body>
</html>
