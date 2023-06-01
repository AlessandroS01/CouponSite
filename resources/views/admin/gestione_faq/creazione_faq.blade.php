@extends('layouts.public')

@section('title', 'Crea FAQ')

@section('content')


    <div class="container-titolo_form">
        <h1> Creazione FAQ</h1>
    </div>

    <div class="container-form">
        <div class="form faq-form">


                    {{ Form::open(array('route' => 'aggiunta FAQ','class' => 'contact-form', 'method' => 'POST', 'id'=>'form_creazione_faq' )) }}
                    @csrf
                    <div  class="container-dati_form_descrizione">
                        {{ Form::label('domanda', 'Domanda:', ['class' => 'label-input']) }}
                        {{ Form::textarea('domanda', '', ['class' => 'input_descrizione', 'id' => 'domanda', 'rows' => 4, 'cols' => 50]) }}

                    </div>

                    <div  class="container-dati_form_descrizione">
                        {{ Form::label('risposta', 'Risposta:', ['class' => 'label-input']) }}
                        {{ Form::textarea('risposta', '', ['class' => 'input_descrizione', 'id' => 'risposta', 'rows' => 4, 'cols' => 50]) }}
                    </div>



                    <div class="container-form_button">
                        {{ Form::submit('Aggiungi', ['class' => 'submit-button']) }}
                    </div>


            {{ Form::close() }}
        </div>

    </div>



@endsection

@section('script')
    <script>
        var actionUrl = "{{ route('aggiunta FAQ') }}";
        var formId = 'form_creazione_faq';
        var homeRoute = '{{ route('home') }}';
    </script>

    <script src="{{ asset('js/AjaxCreazioneFaq.js') }}"></script>
@endsection
