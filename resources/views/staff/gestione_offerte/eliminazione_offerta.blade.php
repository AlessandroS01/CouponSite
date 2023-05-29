@extends('layouts.public')

@section('title', 'Elimina offerta')

@section('link')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('css/gestione_promozioni.css') }}" >
@endsection

@section('content')

    @isset($offerte, $oggetto_offerte, $aziende)

        <div class="container-titolo_form">
            <h1> Elimina offerta</h1>
        </div>

        <div class="form-offerta">

            <div class="container-form-offerta">

                <div>


                    {{ Form::open(array('route' => 'eliminazione offerta', 'class' => 'contact-form', 'method' => 'POST')) }}
                    @csrf
                    {{ Form::hidden('codiceOfferta', null, ['id' => 'hidden_param']) }}

                    <div class="container-dati-offerta">
                        {{ Form::label('offerta', 'Offerta', ['class' => 'label-input']) }}
                        {{ Form::select('offerta', ['-' => '-'] + $oggetto_offerte , null, ['class' => 'input', 'id' => 'offerta']) }}
                    </div>

                    <div  class="container-dati-offerta">
                        {{ Form::label('oggetto_offerta', 'Oggetto offerta', ['class' => 'label-input']) }}
                        {{ Form::text('oggetto_offerta', '', ['class' => 'input', 'id' => 'oggetto_offerta', 'readonly' => 'readonly']) }}

                    </div>
                    @if ($errors->first('oggetto_offerta'))
                        <ul class="errors">
                            @foreach ($errors->get('oggetto_offerta') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div  class="container-dati-offerta">
                        {{ Form::label('data_scadenza', 'Data di scadenza', ['class' => 'label-input']) }}
                        {{ Form::date('data_scadenza', '', ['class' => 'input', 'id' => 'data_scadenza', 'readonly' => 'readonly']) }}

                    </div>
                    @if ($errors->first('data_scadenza'))
                        <ul class="errors">
                            @foreach ($errors->get('data_scadenza') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div  class="container-dati-offerta">
                        {{ Form::label('luogo_fruizione', 'Luogo fruizione', ['class' => 'label-input']) }}
                        {{ Form::text('luogo_fruizione', '', ['class' => 'input','id' => 'luogo_fruizione', 'readonly' => 'readonly']) }}

                    </div>
                    @if ($errors->first('luogo_fruizione'))
                        <ul class="errors">
                            @foreach ($errors->get('luogo_fruizione') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div  class="container-dati-offerta">
                        {{ Form::label('modalita_fruizione', 'Modalita fruizione', ['class' => 'label-input']) }}
                        {{ Form::text('modalita_fruizione', '', ['class' => 'input','id' => 'modalita_fruizione', 'readonly' => 'readonly']) }}

                    </div>
                    @if ($errors->first('modalita_fruizione'))
                        <ul class="errors">
                            @foreach ($errors->get('modalita_fruizione') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                </div>

                <div>

                    <div  class="container-dati-offerta">
                        {{ Form::label('percentuale_sconto', 'Percentuale sconto', ['class' => 'label-input']) }}
                        {{ Form::text('percentuale_sconto', '', ['class' => 'input', 'id' => 'percentuale_sconto', 'readonly' => 'readonly']) }}


                    </div>
                    @if ($errors->first('percentuale_sconto'))
                        <ul class="errors">
                            @foreach ($errors->get('percentuale_sconto') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div  class="container-dati-offerta">
                        {{ Form::label('prezzo_pieno', 'Prezzo pieno', ['class' => 'label-input']) }}
                        {{ Form::text('prezzo_pieno', '', ['class' => 'input', 'id' => 'prezzo_pieno', 'readonly' => 'readonly']) }}
                    </div>
                    @if ($errors->first('prezzo_pieno'))
                        <ul class="errors">
                            @foreach ($errors->get('prezzo_pieno') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="container-dati-offerta ">
                        {{ Form::label('categoria', 'Categoria', ['class' => 'label-input']) }}
                        {{ Form::text('categoria', '', ['class' => 'input', 'id' => 'categoria', 'readonly' => 'readonly']) }}

                    </div>
                    @if ($errors->first('categoria'))
                        <ul class="errors">
                            @foreach ($errors->get('categoria') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="container-dati-offerta ">
                        {{ Form::label('azienda', 'Azienda', ['class' => 'label-input']) }}
                        {{ Form::text('azienda', '', ['class' => 'input', 'id' => 'azienda', 'readonly' => 'readonly']) }}

                    </div>
                    @if ($errors->first('azienda'))
                        <ul class="errors">
                            @foreach ($errors->get('azienda') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif


                    <div class="container-dati-offerta">
                        {{ Form::label('descrizione', 'Descrizione', ['class' => 'label-input']) }}
                        {{ Form::text('descrizione', '', ['class' => 'input', 'id' => 'descrizione', 'readonly' => 'readonly']) }}

                    </div>
                    @if ($errors->first('descrizione'))
                        <ul class="errors">
                            @foreach ($errors->get('descrizione') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>



            </div>

            <div class="container-offerta_button">
                {{ Form::submit('Elimina', ['class' => 'submit-button']) }}
            </div>


            {{ Form::close() }}
        </div>

    @endisset

@endsection

@section('script')
    <script>
        var aziende = {!! $aziende !!};
        var offerte = {!! $offerte !!}
    </script>

    <script src="{{ asset('js/EliminazioneOfferta.js') }}"></script>
@endsection



