@extends('layouts.public')

@section('title', 'Aggiunta Azienda')

@section('content')


    <div class="container-titolo_form">
        <h1> Aggiunta Azienda</h1>
    </div>

    <div class="container-form">
        <div class="form">
            <div class="container-form-gestione">
                <div>
                    <!-- enctype: multipart/form-data indica che il form può contenere campi di
                    input di tipo file e che i dati di tali
                    campi verranno inviati al server come parte separata della richiesta HTTP-->
                    <!--Form collegato alla rotta di aggiunta azienda -->
                    {{ Form::open(array('route' => 'aggiunta azienda', 'class' => 'contact-form', 'method' => 'POST', 'files' => true, 'enctype' => 'multipart/form-data')) }}
                    @csrf
                    <div  class="container-dati_form">
                        {{ Form::label('nome', 'Nome', ['class' => 'label-input']) }}
                        {{ Form::text('nome', '', ['class' => 'input']) }}
                    </div>
                    @if ($errors->first('nome'))
                        <ul class="errors">
                            @foreach ($errors->get('nome') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif


                    <div class="container-dati_form">
                        {{ Form::label('localita', 'Località', ['class' => 'label-input']) }}
                        {{ Form::text('localita', '', ['class' => 'input']) }}

                    </div>
                    @if ($errors->first('localita'))
                        <ul class="errors">
                            @foreach ($errors->get('localita') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif


                    <div  class="container-dati_form">
                        {{ Form::label('partita_iva', 'Partita Iva', ['class' => 'label-input']) }}
                        {{ Form::text('partita_iva','', ['class' => 'input']) }}

                    </div>
                    @if ($errors->first('partita_iva'))
                        <ul class="errors">
                            @foreach ($errors->get('partita_iva') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif


                    <div  class="container-dati_form">
                        {{ Form::label('email', 'Email', ['class' => 'label-input']) }}
                        {{ Form::text('email', '', ['class' => 'input']) }}

                    </div>
                    @if ($errors->first('email'))
                        <ul class="errors">
                            @foreach ($errors->get('email') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>


                <div>
                    <div class="container-dati_form">
                        {{ Form::label('telefono', 'Telefono', ['class' => 'label-input']) }}
                        {{ Form::text('telefono', '', ['class' => 'input']) }}
                    </div>
                    @if ($errors->first('telefono'))
                        <ul class="errors">
                            @foreach ($errors->get('telefono') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif


                    <div class="container-dati_form">
                        {{ Form::label('logo', 'Logo', ['class' => 'label-input']) }}
                        {{ Form::file('logo', ['class' => 'input']) }}
                    </div>
                    @if ($errors->first('logo'))
                        <ul class="errors">
                            @foreach ($errors->get('logo') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif


                    <div class="container-dati_form">
                        {{ Form::label('tipologia', 'Tipologia', ['class' => 'label-input']) }}
                        {{ Form::text('tipologia', '', ['class' => 'input']) }}

                    </div>
                    @if ($errors->first('tipologia'))
                        <ul class="errors">
                            @foreach ($errors->get('tipologia') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif


                    <div class="container-dati_form">
                        {{ Form::label('ragione_sociale', 'Ragione Sociale', ['class' => 'label-input']) }}
                        {{ Form::text('ragione_sociale', '', ['class' => 'input']) }}

                    </div>
                    @if ($errors->first('ragione_sociale'))
                        <ul class="errors">
                            @foreach ($errors->get('ragione_sociale') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                </div>
            </div>

            <div class="form_descrizione">
                <div  class="container-dati_form_descrizione">
                    {{ Form::label('descrizione', 'Descrizione', ['class' => 'label-input']) }}
                    {{ Form::textarea('descrizione', '', ['class' => 'input_descrizione']) }}


                    @if ($errors->first('descrizione'))
                        <ul class="errors">
                            @foreach ($errors->get('descrizione') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                </div>
            </div>

            <div class="container-form_button">
                {{ Form::submit('Aggiungi', ['class' => 'submit-button']) }}
            </div>


            {{ Form::close() }}
        </div>

    </div>

@endsection
