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

            <div class="container-logo_sito">
                <a href="{{ route('home') }}"> <img src="{{ asset('img/logo.png') }}" alt="site logo"> </a>
            </div>

        </div>

        @isset($offertaSelezionata)

            <p> {{ $offertaSelezionata->codice }}</p>

        @endisset



    </body>
</html>
