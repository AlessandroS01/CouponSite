@extends('layouts.public')

@section('title', 'Elimina FAQ')

@section('content')

    <div class="container-titolo_form">
        <h1> Elimina FAQ</h1>
    </div>

    @isset($faq)

        <div class="container-form">
            <div class="form">

                {{ Form::open(array('route' => 'elimina FAQ', 'class' => 'contact-form', 'method' => 'POST')) }}

                @csrf
                {{ Form::hidden('idfaq', null, ['id' => 'hidden_param']) }}

                <div  class="container-dati_form">
                    {{ Form::label('faq', 'Faq', ['class' => 'label-input']) }}

                    {{ Form::select('faq', [ '-' => '-'] + $faqdomanda, null,  ['class' => 'input']) }}
                </div>

                <div class="form_descrizione">

                    <div>
                        <div  class="container-dati_form_descrizione">
                            {{ Form::label('domanda', 'Domanda', ['class' => 'label-input']) }}
                            {{ Form::textarea('domanda', '', ['class' => 'input_descrizione', 'id'=>'domanda', 'readonly'=>'readonly']) }}

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
                            {{ Form::textarea('risposta', '', ['class' => 'input_descrizione', 'id'=>'risposta', 'readonly'=>'readonly']) }}

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
                    {{ Form::submit('Elimina FAQ', ['class' => 'submit-button']) }}
                </div>


                {{ Form::close() }}
            </div>
        </div>

    @endisset

@endsection

@section('script')
    <script>
        // prende il valore di tutte le faq codificate in JSON direttamente da php
        var faqs = {!! ($faq) !!}

    </script>

    <script src="{{ asset('js/ModificaFaq.js') }}"></script>
@endsection
