<!-- Viene esteso il layout public -->
@extends('layouts.public')

@section('title', 'Home')

@section('content')
    <!-- Blocco di codice html che richiama la rotta download.documento
     per andare a scaricare la documentazione-->
    <div class="download-document">
        <a href="{{ route('download.documento') }}">Scarica il documento di Relazione del progetto</a>
    </div>

<section id="aziende" class="slide-aziende">


    <div class="title-section-aziende">
        <h1 class="titolo-sezione-aziende">Aziende in evidenza</h1>
    </div>


    <div class="container">

        <div class="slideshow-container">
            <!-- Blocco iterativo per andare a creare lo slideshow -->
            @foreach($catalogoAziende->getPrimiTreElementi() as $index => $azienda )

                <!-- Gestione del numero della slide corrente -->
                <div class="slide fade">
                    <div class="numbertext">{{ $index + 1 }} / 3</div>
                    <img src="{{ asset($azienda->logo) }}" style="width:100%">
                </div>

            @endforeach

            <!-- Viene associato al click delle freccette dello slideshow
            il passaggio alla slide successiva o precedente-->
            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>

            <!-- Contenitore dei puntini delle slide nel quale identifico
            la slide selezionata dello slideshow-->
            <div id="dot-container">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            </div>

        </div>

        <div id="row-aziende">
            <div id="aziende-container">

                <!-- Blocco condizionale nel quale andiamo a scorrere 5 aziende
                 e queste vengono impostate in cards fatte visualizzare-->
                @foreach($catalogoAziende->getPrimiCinqueElementi() as $azienda)

                    <div class="card-azienda">
                        <!-- Immagine dell'azienda, la cui sorgente è recuperata
                        tramite l'URL specificato nella variabile $azienda->logo -->
                        <img src="{{ asset($azienda->logo) }}" >

                        <!-- Link che porta alla pagina dell'azienda,
                        utilizzando la route 'azienda' e passando la partita IVA come parametro -->
                        <!-- Utilizzando  $azienda->nome andiamo ad impostare il nome dell'azienda
                         all'interno della card-->
                        <a href="{{ route('azienda', [ 'partita_iva' => $azienda->partita_iva ] ) }}">{{ $azienda->nome }}</a>
                    </div>

                @endforeach

            </div>
        </div>
    </div>

</section>

<!-- Definiamo una sezione nella quale andiamo a far visualizzare le offerte in evidenza-->
<section id="offerte-home">

    <div class="title-offerte-home">

    <h1>Offerte in evidenza</h1>
    </div>


    <div class="container-offerte">

        <!-- Blocco condizionale che prende 3 offerte e per ciascuna
         vado a impostare le varie caratteristiche all'interno della card -->
        @foreach($catalogoOfferte->getPrimiTreElementi() as $offerta)

            <div class="card">

                <div class="img-container">
                    <img src="{{ asset( $catalogoOfferte->getLogoAziendaByOfferta($offerta)) }}" alt="logo offerta" >
                </div>

                <div class="info">
                    <h1>{{ $offerta->oggetto_offerta }}</h1>
                    <p>{{ $offerta->descrizione }}</p>
                </div>

                <div class="button">
                    <!-- Associo il bottone ottieni alla rotta offerta specificando
                     il codice di quest'ultima-->
                    <a href="{{ route('offerta', ['offertaId' => $offerta->codice] ) }}">ottieni</a>
                </div>

                <div class="badge">
                    <!-- Viene settata la percentuale di sconto all'interno della card -->
                    <p>{{ $offerta -> percentuale_sconto }}%</p>
                </div>

            </div>

        @endforeach

    </div>

    <div class="title-offerte-home">
        <h1>Scadono a breve</h1>
    </div>

    <div class="container-offerte">
        <!-- Vengono selezionate le offerte che scadono a breve tramite la funzione getElementiDataScadenza()
        e per ciascuna viene settata la card con i parametri specifici dell'offerta-->
        @foreach($catalogoOfferte->getElementiDataScadenza() as $offerta)

            <div class="card">

                <div class="img-container">
                    <img src="{{ asset( $catalogoOfferte->getLogoAziendaByOfferta($offerta)) }}" alt="logo offerta" >
                </div>

                <div class="info">
                    <h1>{{ $offerta->oggetto_offerta }}</h1>
                    <p>{{ $offerta->descrizione }}</p>
                </div>

                <div class="button">
                    <!-- Associo il bottone ottieni alla rotta offerta specificando
                    il codice di quest'ultima-->
                    <a href="{{ route('offerta', ['offertaId' => $offerta->codice]) }}">ottieni</a>
                </div>

                <div class="badge">
                    <p>{{ $offerta -> percentuale_sconto }}%</p>
                </div>

            </div>

        @endforeach

    </div>




</section>
@endsection
