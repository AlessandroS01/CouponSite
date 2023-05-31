@extends('layouts.public')

@section('title', 'Creazione offerta')

@section('link')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('css/gestione_promozioni.css') }}" >
@show

@section('content')


    @isset($aziende)
        <div class="container-titolo_form">
            <h1> Creazione offerta</h1>
        </div>

        <div class="form-offerta">

            <div class="container-form-offerta">

                <div>
                    {{ Form::open(array('class' => 'contact-form', 'method' => 'POST', 'id'=>'form_creazione_offerta')) }}
                    @csrf
                    {{ Form::hidden('flagAttivo', 1, ['id' => 'hidden_param']) }}
                    <div  class="container-dati-offerta">
                        {{ Form::label('oggetto_offerta', 'Oggetto offerta', ['class' => 'label-input']) }}
                        {{ Form::text('oggetto_offerta', '', ['class' => 'input', 'id' => 'oggetto_offerta']) }}

                    </div>

                    <div  class="container-dati-offerta">
                        {{ Form::label('data_scadenza', 'Data di scadenza', ['class' => 'label-input']) }}
                        {{ Form::date('data_scadenza', '', ['class' => 'input', 'id' => 'data_scadenza']) }}

                    </div>

                    <div  class="container-dati-offerta">
                        {{ Form::label('luogo_fruizione', 'Luogo fruizione', ['class' => 'label-input']) }}
                        {{ Form::text('luogo_fruizione', '', ['class' => 'input','id' => 'luogo_fruizione']) }}

                    </div>

                    <div  class="container-dati-offerta">
                        {{ Form::label('modalita_fruizione', 'Modalita fruizione', ['class' => 'label-input']) }}
                        {{ Form::text('modalita_fruizione', '', ['class' => 'input','id' => 'modalita_fruizione']) }}

                    </div>

                    <div  class="container-dati-offerta">
                        {{ Form::label('percentuale_sconto', 'Percentuale sconto', ['class' => 'label-input']) }}
                        {{ Form::text('percentuale_sconto', '', ['class' => 'input', 'id' => 'percentuale_sconto']) }}


                    </div>
                </div>

                <div>
                    <div  class="container-dati-offerta">
                        {{ Form::label('prezzo_pieno', 'Prezzo pieno', ['class' => 'label-input']) }}
                        {{ Form::text('prezzo_pieno', '', ['class' => 'input', 'id' => 'prezzo_pieno']) }}
                    </div>

                    <div class="container-dati-offerta ">
                        {{ Form::label('categoria', 'Categoria', ['class' => 'label-input']) }}
                        {{ Form::text('categoria', '', ['class' => 'input', 'id' => 'categoria']) }}

                    </div>


                    <div class="container-dati-offerta">
                        {{ Form::label('azienda', 'Azienda', ['class' => 'label-input']) }}
                        {{ Form::select('azienda', $aziende, null, ['class' => 'input', 'id' => 'azienda']) }}


                    </div>

                    <div class="container-dati-offerta">
                        {{ Form::label('descrizione', 'Descrizione', ['class' => 'label-input']) }}
                        {{ Form::text('descrizione', '', ['class' => 'input', 'id' => 'descrizione']) }}

                    </div>
                </div>





            </div>

            <div class="container-offerta_button">
                {{ Form::submit('Crea', ['class' => 'submit-button']) }}
            </div>


            {{ Form::close() }}
        </div>
    @endisset


@endsection

@section('script')
    <script>
        var actionUrl = "{{ route('creazione offerta') }}";
        var formId = 'form_creazione_offerta';
    </script>

    <script src="{{ asset('js/AjaxCreazioneOfferta.js') }}"></script>
@endsection

