@extends('layouts.public')

@section('title', 'Offerta')

@section('content')

    <div class="container-offerta_completa">

        <div>
            <h1> Categoria del prodotto</h1>
            <img src="img/amazon.png"> 
        </div>  
        

        <div class="container-dettagli-offerta">
            <h1> Prodotto in offerta</h1>
            <!-- l'href va puntato alla pagina dell'azienda -->
            <a class="ancora_azienda"href=" {{ route('azienda') }}"> 
                Azienda riferimento 
            </a>

            <div class="container-prezzo_offerta">
                <span class="span-offerta"> Offerta </span>
                <div class="container-prezzo_scontato">
                    <h2 class="sconto_offerta"> -20% </h2>
                    
                    <h2 class="prezzo_scontato"> &#8364<span>9,99</span> </h2>
                </div>
                
                <h6> Prezzo iniziale: &#8364<span>12,50</span></h6>
            </div>
            <hr>
            <!-- Descrizione dell'offerta -->
            <p class="descrizione-offerta"> Descrizione Offerta.

        </div>

        <div class="container-acquisizione_offerta">

            <!-- Modalità di fruizione dell'offerta -->
            <p class="modalita-fruizione_offerta"> Modalità di fruizione dell'offerta </p>
            <p class="data-scadenza_offerta"> Data di scadenza dell'offerta </p>

            <h3> &#8364<span>9,99</span></h3>
            
            <div class="bottone-acquisizione">
                <a href="{{ route('login') }}">ottieni</a>
            </div>

        </div>
        


    </div>

@endsection