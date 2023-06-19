@extends('layouts.public')

@section('title', 'Elimina Azienda')

@section('content')

    @isset($aziende)
        <div class="container-titolo_form">
            <h1> Elimina Azienda</h1>
        </div>

        <div class="container-form">
            <div class="form">
                <!-- enctype: multipart/form-data indica che il form può contenere campi di input di tipo file e che i dati di tali
                    campi verranno inviati al server come parte separata della richiesta HTTP-->
                <!--Form collegato alla rotta di eliminazione azienda -->
                {{ Form::open(array('route' => 'eliminazione azienda', 'class' => 'contact-form', 'method' => 'POST', 'files' => true, 'enctype' => 'multipart/form-data')) }}
                @csrf
                @isset($partitaIvaAziende)
                    <div  class="container-dati_form">
                        {{ Form::label('azienda', 'Azienda', ['class' => 'label-input']) }}
                        <!--Selezioniamo la partita iva di un'azienda nella select e si attiverà il meccanismo
                        javascript che riempirà in automatico i campi di input del form-->
                        {{ Form::select('azienda', [ '-' => '-'] + $partitaIvaAziende, null, ['class' => 'input', 'id' => 'nomeAzienda']) }}
                    </div>
                @endisset

                <div class="container-form-gestione">
                    <div>

                        <div  class="container-dati_form">
                            {{ Form::label('nome', 'Nome', ['class' => 'label-input']) }}
                            {{ Form::text('nome', '', ['class' => 'input', 'readonly'=>'readonly']) }}
                        </div>

                        <div class="container-dati_form">
                            {{ Form::label('localita', 'Località', ['class' => 'label-input']) }}
                            {{ Form::text('localita', '', ['class' => 'input', 'readonly'=>'readonly']) }}

                        </div>

                        <div  class="container-dati_form">
                            {{ Form::label('partita_iva', 'Partita Iva', ['class' => 'label-input']) }}
                            {{ Form::text('partita_iva','', ['class' => 'input', 'readonly'=>'readonly']) }}

                        </div>

                        <div  class="container-dati_form">
                            {{ Form::label('email', 'Email', ['class' => 'label-input']) }}
                            {{ Form::text('email', '', ['class' => 'input', 'readonly'=>'readonly']) }}

                        </div>
                    </div>


                    <div>
                        <div class="container-dati_form">
                            {{ Form::label('telefono', 'Telefono', ['class' => 'label-input']) }}
                            {{ Form::text('telefono', '', ['class' => 'input', 'readonly'=>'readonly']) }}
                        </div>

                        <div class="container-dati_form">
                            {{ Form::label('tipologia', 'Tipologia', ['class' => 'label-input']) }}
                            {{ Form::text('tipologia', '', ['class' => 'input', 'readonly'=>'readonly']) }}

                        </div>

                        <div class="container-dati_form">
                            {{ Form::label('ragione_sociale', 'Ragione Sociale', ['class' => 'label-input']) }}
                            {{ Form::text('ragione_sociale', '', ['class' => 'input', 'readonly'=>'readonly']) }}

                        </div>

                    </div>
                </div>

                <div class="form_descrizione">
                    <div  class="container-dati_form_descrizione">
                        {{ Form::label('descrizione', 'Descrizione', ['class' => 'label-input']) }}
                        {{ Form::textarea('descrizione', '', ['class' => 'input_descrizione', 'readonly'=>'readonly']) }}
                    </div>
                </div>


                <div class="container-logo-modifica_azienda">
                    <div>

                        {{ Form::label('', 'Logo', ['class' => 'label-input']) }}
                        <div class="input">
                            <img src="{{ asset('') }}" alt="Image" id="logo-preview">
                        </div>
                    </div>


                </div>

                <div class="container-form_button">
                    {{ Form::submit('Elimina', ['class' => 'submit-button']) }}
                </div>


                {{ Form::close() }}
            </div>

        </div>
    @endisset


@endsection

@section('script')
    <script>
        //creo un array contenente tutte le aziende
        var aziende = {!! $aziende !!};
        //in public_url inserisco il path http://localhost/CouponSite/public, utilizzo l'helper url('/') per ottenerla
        var public_url = {!! json_encode(url('/')) !!};
    </script>

    <script src="{{ asset('js/ModificaAzienda.js') }}"></script>
@endsection
