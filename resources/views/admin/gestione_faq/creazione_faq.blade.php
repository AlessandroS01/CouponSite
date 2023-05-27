@extends('layouts.public')

@section('title', 'Aggiunta Azienda')

@section('content')


    <div class="container-offerta_dettagli">
        <h1> Creazione FAQ</h1>
    </div>

    <div class="container-form">
        <div class="form">
            <div class="container-form-gestione">
                <div>
                    {{ Form::open(array('route' => 'aggiunta FAQ', 'class' => 'contact-form', 'method' => 'POST')) }}

                    <div  class="container-dati_form">
                        {{ Form::label('nome', 'Nome', ['class' => 'label-input']) }}
                        {{ Form::textarea('nome', '', ['class' => 'input', 'id' => 'nome', 'rows' => 4, 'cols' => 50]) }}

                    </div>

                </div>

            </div>

            <div class="container-form_button">
                {{ Form::submit('Aggiungi', ['class' => 'submit-button']) }}
            </div>


            {{ Form::close() }}
        </div>

    </div>



@endsection
