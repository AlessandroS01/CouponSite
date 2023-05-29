@extends('layouts.public')

@section('title', 'Modifica staff')


@section('content')


    <div class="container-offerta_dettagli">
        <h1> Modifica FAQ</h1>
    </div>


    <div class="container-form">
            <div class="form">

                {{ Form::open(array('route' => 'modifica FAQ', 'class' => 'contact-form', 'method' => 'POST')) }}

                <div  class="container-dati_form">
                    {{ Form::label('faq', 'Faq', ['class' => 'label-input']) }}

                    {{ Form::select('faq', [ '-' => '-'], null,  ['class' => 'input']) }}
                </div>

                <div class="form_descrizione">

                    <div>
                        <div  class="container-dati_form_descrizione">
                            {{ Form::label('domanda', 'Domanda', ['class' => 'label-input']) }}
                            {{ Form::textarea('domanda', '', ['class' => 'input_descrizione']) }}

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
                            {{ Form::textarea('risposta', '', ['class' => 'input_descrizione']) }}

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


@endsection
