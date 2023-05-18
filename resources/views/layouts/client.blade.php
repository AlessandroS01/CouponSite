<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/faq.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/contatti.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/catalogo.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/offerta.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/azienda.css') }}" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

    
    <title>@yield('title', 'Coupon')</title>
</head>

<body>

    <nav class="topnav" id="myTopnav">
        @include('layouts/_navclient')
    </nav>

    <section id="contenuto">
        @yield('content')
    </section>
    
    <footer>
        <div class="container-footer">
            <div>
                <h3>Il nostro sito di coupon</h3>
                <p>Scopri le migliori offerte e risparmia!</p>
            </div>
                <ul class="container-navbar-footer">
                    @include('layouts/_foopublic')
                </ul>

        </div>
    </footer>

    
</body>
<script src="{{ asset('js/slideshow.js') }}" ></script>
<script src="{{ asset('js/faqs.js') }}"></script>
</html>