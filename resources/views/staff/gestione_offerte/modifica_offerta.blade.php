@extends('layouts.public')

@section('title', 'Creazione promozione')

@section('content')

    <!--
        $offerte => lista di tutte le offerte che il membro dello staff può gestire da utilizzare per riempire
                i campi della form in modo automatico
        $oggetto_offerte => lista di tutti gli oggetti delle offerte usate per riempire la select all'iterno della form
        $aziende => lista di tutte le aziende che il membro dello staff può gestire
    -->
    @isset($offerte, $oggetto_offerte, $aziende)

        <div class="container-offerta_dettagli">
            <h1> Modifica offerta</h1>
        </div>

        <div class="form-offerta">

            <div class="container-form-offerta">

                <div>


                    {{ Form::open(array('route' => 'modifica offerta', 'class' => 'contact-form', 'method' => 'POST')) }}

                    {{ Form::hidden('codiceOfferta', null, ['id' => 'hidden_param']) }}

                    <div class="container-dati-offerta">
                        {{ Form::label('offerta', 'Offerta', ['class' => 'label-input']) }}
                        {{ Form::select('offerta', ['-' => '-'] + $oggetto_offerte , null, ['class' => 'input', 'id' => 'offerta', 'data-offerta' => $offerte, 'data-aziende' => $aziende ]) }}
                    </div>

                    <div  class="container-dati-offerta">
                        {{ Form::label('oggetto_offerta', 'Oggetto offerta', ['class' => 'label-input']) }}
                        {{ Form::text('oggetto_offerta', '', ['class' => 'input', 'id' => 'oggetto_offerta']) }}

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
                        {{ Form::date('data_scadenza', '', ['class' => 'input', 'id' => 'data_scadenza']) }}

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
                        {{ Form::text('luogo_fruizione', '', ['class' => 'input','id' => 'luogo_fruizione']) }}

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
                        {{ Form::text('modalita_fruizione', '', ['class' => 'input','id' => 'modalita_fruizione']) }}

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
                        {{ Form::text('percentuale_sconto', '', ['class' => 'input', 'id' => 'percentuale_sconto']) }}


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
                        {{ Form::text('prezzo_pieno', '', ['class' => 'input', 'id' => 'prezzo_pieno']) }}
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
                        {{ Form::text('categoria', '', ['class' => 'input', 'id' => 'categoria']) }}

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
                        {{ Form::text('descrizione', '', ['class' => 'input', 'id' => 'descrizione']) }}

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
                {{ Form::submit('Modifica', ['class' => 'submit-button']) }}
            </div>


            {{ Form::close() }}
        </div>



    @endisset

    <script>
        $(document).ready(function() {
            // script che viene eseguito solo dopo che il campo all'interno della select viene cambiato
            $('#offerta').change(function () {

                // prende il valore di tutte le aziende codificate in JSON direttamente da php
                var encodedAziende = '{!! json_encode($aziende) !!}'
                // effettua il parsing del json per ottenere un array delle tuple contenente tutte le aziende
                var aziende = JSON.parse(encodedAziende);

                // prende il valore di tutte le offerte codificate in JSON direttamente da php
                var encodedOfferte = '{!! json_encode($offerte) !!}';
                // effettua il parsing del json per ottenere un array delle tuple contenente tutte le offerte
                var offerte = JSON.parse(encodedOfferte);

                // quando il valore cliccato sulla selection è diverso da '-' entra all'interno dell'if
                if ( $(this).val() !== '-') {

                    // prende l'offerta che si trova alla posizione i-esima
                    var oggettoOffertaSelezionata = offerte[$(this).val()];
                    // variabile che serve a contenere il nome dell'azienda relativa a quell'offerta perchè
                    // all'interno della tabella Offerta è presente come chiave esterna la partita_iva e non il nome
                    var azienda = null;

                    // crea un loop con un indice al più pari alla lunghezza dell'array contenente tutte le aziende
                    for( var i = 0; i < aziende.length; i++){
                        // quando la partita iva dell'offerta selezionata è pari alla partita iva di un'azienda presente
                        // all'interno dell'array contenente tutte le aziende setta il valore della variabile azienda
                        // uguale al nome dell'azienda stessa
                        if(aziende[i].partita_iva == oggettoOffertaSelezionata.azienda){
                            azienda = aziende[i].nome;
                        }
                    }
                    // popola tutti i campi della form
                    // Dato che per la modifica è necessario anche sapere il codice dell'offerta che si vuole modificare,
                    // viene inviato anche un parametro hidden contenente il valore del codice dell'offerta selezionata.
                    $('#hidden_param').val(oggettoOffertaSelezionata.codice);
                    $('#oggetto_offerta').val(oggettoOffertaSelezionata.oggetto_offerta);
                    $('#data_scadenza').val(oggettoOffertaSelezionata.data_scadenza);
                    $('#luogo_fruizione').val(oggettoOffertaSelezionata.luogo_fruizione);
                    $('#modalita_fruizione').val(oggettoOffertaSelezionata.modalita_fruizione);
                    $('#percentuale_sconto').val(oggettoOffertaSelezionata.percentuale_sconto);
                    $('#prezzo_pieno').val(oggettoOffertaSelezionata.prezzo_pieno);
                    $('#categoria').val(oggettoOffertaSelezionata.categoria);
                    // questa parte permette di non poter modificare l'azienda che ha emesso la promozione
                    $('#azienda').val(azienda).prop('readonly', true);
                    $('#descrizione').val(oggettoOffertaSelezionata.descrizione);

                // se invece si seleziona '-' tutti i campi vengono resettati
                }else{
                    $('#oggetto_offerta').val("");
                    $('#data_scadenza').val("");
                    $('#luogo_fruizione').val("");
                    $('#modalita_fruizione').val("");
                    $('#percentuale_sconto').val("");
                    $('#prezzo_pieno').val("");
                    $('#categoria').val("");
                    $('#azienda').val("").prop('readonly', true);
                    $('#descrizione').val("");
                    $('#hidden_param').val("");
                }

            });
        })
    </script>
@endsection
