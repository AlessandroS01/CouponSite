@extends('layouts.public')

@section('title', 'Modifica staff')


@section('content')


    <div class="container-offerta_dettagli">
        <h1> Modifica FAQ</h1>
    </div>


    <div class="container-form">
            <div class="form">

                {{ Form::open(array('route' => 'modifica FAQ', 'class' => 'contact-form', 'method' => 'POST')) }}

                @csrf
                {{ Form::hidden('idFaq', null, ['id' => 'hidden_param']) }}

                <div  class="container-dati_form">
                    {{ Form::label('faq', 'Faq', ['class' => 'label-input']) }}

                    {{ Form::select('faq', [ '-' => '-'] + $faqs, null,  ['class' => 'input']) }}
                </div>

                <div class="form_descrizione">

                    <div>
                        <div  class="container-dati_form_descrizione">
                            {{ Form::label('domanda', 'Domanda', ['class' => 'label-input']) }}
                            {{ Form::textarea('domanda', '', ['class' => 'input_descrizione', 'id'=>'domanda']) }}

                        </div>
                        @if ($errors->first('domanda'))
                            <ul class="errors">
                                @foreach ($errors->get('domanda') as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>


                    <div>

                        <div  class="container-dati_form_descrizione">
                            {{ Form::label('risposta', 'Risposta', ['class' => 'label-input']) }}
                            {{ Form::textarea('risposta', '', ['class' => 'input_descrizione', 'id'=>'risposta']) }}

                        </div>
                        @if ($errors->first('risposta'))
                            <ul class="errors">
                                @foreach ($errors->get('risposta') as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>

                </div>

                <div class="container-form_button">
                    {{ Form::submit('Modifica FAQ', ['class' => 'submit-button']) }}
                </div>


                    {{ Form::close() }}
                </div>
            </div>
    </div>

    <script>
        $(document).ready(function() {
            // script che viene eseguito solo dopo che il campo all'interno della select viene cambiato
            $('#faq').change(function () {

                // prende il valore di tutte le faq codificate in JSON direttamente da php
                var faqs = {!! ($faqs) !!}

                // quando il valore cliccato sulla selection è diverso da '-' entra all'interno dell'if
                if ( $(this).val() !== '-') {

                    // prende l'offerta che si trova alla posizione i-esima
                    var oggettoFaqSelezionata = faqs[ $(this).val() ];

                    // popola tutti i campi della form
                    $('#hidden_param').val(oggettoFaqSelezionata.id);
                    $('#domanda').val(oggettoFaqSelezionata.domanda);
                    $('#risposta').val(oggettoFaqSelezionata.risposta);

                    // se invece si seleziona '-' tutti i campi vengono resettati
                }else{
                    $('#domanda').val("");
                    $('#risposta').val("");
                    $('#hidden_param').val("");
                }

            });
        })
    </script>



@endsection
