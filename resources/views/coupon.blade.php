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

        @isset($offertaSelezionata, $gestoreOfferte)
            <div class="container">

                <div class="container-coupon_string">

                    <h1> Codice del coupon generato </h1>

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


        @endisset



    </body>
</html>
