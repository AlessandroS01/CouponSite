<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-Gqz4GsPTU2aRzajEVbUTLx7Z3+jHgcKYB4NKR3U8wxcVUQn/itPFkF8rCmThfiZ5" crossorigin="anonymous"></script>



@section('link')
        <link rel="stylesheet" type="text/css" href="{{ asset('css/global.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset('css/gestione_form.css') }}" >
        <!-- Riga di codica che serve ad importare il font -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <!-- Riga di codica che importa una libreria che contiene le icone.
        In base al tipo di icona che si vuole utilizzare si cambia il codice della classe css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/admin_gestione_faq.css') }}" >
    @show

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>






    <title>@yield('title', 'Coupon')</title>
</head>

<body>

    <nav class="topnav" id="myTopnav">
        @include('layouts/_navpublic')
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
@yield('script')
<script src="{{ asset('js/Slideshow.js') }}" ></script>
<script src="{{ asset('js/VisualizzaFaq.js') }}"></script>
</html>
