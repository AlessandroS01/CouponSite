@extends('layouts.public')

@section('title', 'Aggiunta Azienda')

@section('content')


    <div class="container-offerta_dettagli">
        <h1> Creazione FAQ</h1>
    </div>

    <div class="container-form">
        <div class="form faq-form">


                    {{ Form::open(array('route' => 'aggiunta FAQ', 'class' => 'contact-form', 'method' => 'POST')) }}

                    <div  class="container-dati_form_descrizione">
                        {{ Form::label('domanda', 'Domanda:', ['class' => 'label-input']) }}
                        {{ Form::textarea('domanda', '', ['class' => 'input_descrizione', 'id' => 'faq-input-text', 'rows' => 4, 'cols' => 50]) }}

                    </div>

                    <div  class="container-dati_form_descrizione">
                        {{ Form::label('risposta', 'Risposta:', ['class' => 'label-input']) }}
                        {{ Form::textarea('risposta', '', ['class' => 'input_descrizione', 'id' => 'faq-input-text', 'rows' => 4, 'cols' => 50]) }}

                    </div>



            <div class="container-form_button">
                {{ Form::submit('Aggiungi', ['class' => 'submit-button']) }}
            </div>


            {{ Form::close() }}
        </div>

    </div>



@endsection
