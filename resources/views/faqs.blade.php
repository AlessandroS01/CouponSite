@extends('layouts.public')

@section('title', 'FAQ')

@section('link')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('css/faq.css') }}" >
@endsection
@section('content')

<section id="faqs">

    <div class="faq-container">

        <h1 class="titolo-faq">FAQs</h1>

        <!-- Per ogni elemento ottenuto dal controller genera un codice html per contenere
        all'interno di un titolo le domande e all'interno di un paragrafo la risposta-->
        @foreach ($faqs as $faq)

            <button class="accordion">{{ $faq->domanda }}</button>
            <div class="container-risposta">
                <p>{{ $faq->risposta }}</p>
            </div>

        @endforeach

    </div>



</section>

@endsection
