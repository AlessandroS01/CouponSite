@extends('layouts.public')

@section('title', 'Home')


@section('content')
    <div class="download-document">
        <a href="{{ route('download.documento') }}">Scarica il documento di Relazione del progetto</a>
    </div>

<section id="aziende" class="slide-aziende">


    <div class="title-section-aziende">
        <h1 class="titolo-sezione-aziende">Aziende in evidenza</h1>
    </div>


    <div class="container">

        <div class="slideshow-container">

            @foreach($catalogoAziende->getPrimiTreElementi() as $index => $azienda )

                <div class="slide fade">
                    <div class="numbertext">{{ $index + 1 }} / 3</div>
                    <img src="{{ asset($azienda->logo) }}" style="width:100%">
                </div>

            @endforeach

            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>

            <div id="dot-container">
            <span class="dot" onclick="currentSlide(1)"></span>
            <span class="dot" onclick="currentSlide(2)"></span>
            <span class="dot" onclick="currentSlide(3)"></span>
            </div>

        </div>

        <div id="row-aziende">
            <div id="aziende-container">

                @foreach($catalogoAziende->getPrimiCinqueElementi() as $azienda)

                    <div class="card-azienda">
                    <img src="{{ asset($azienda->logo) }}" >
                    <a href="{{ route('azienda', [ 'partita_iva' => $azienda->partita_iva ] ) }}">{{ $azienda->nome }}</a>
                    </div>

                @endforeach

            </div>
        </div>
    </div>

</section>


<section id="offerte-home">

    <!-- Per ogni prodotto ottenuto dal controller gestire il dato-->
    <div class="title-offerte-home">

    <h1>Offerte in evidenza</h1>
    </div>


    <div class="container-offerte">

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
                    <a href="{{ route('offerta', ['offertaId' => $offerta->codice] ) }}">ottieni</a>
                </div>

                <div class="badge">
                    <p>{{ $offerta -> percentuale_sconto }}%</p>
                </div>

            </div>

        @endforeach

    </div>

    <div class="title-offerte-home">
        <h1>Scadono a breve</h1>
    </div>

    <div class="container-offerte">

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
