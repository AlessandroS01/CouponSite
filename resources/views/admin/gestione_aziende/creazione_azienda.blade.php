@extends('layouts.public')

@section('title', 'Aggiunta Azienda')

@section('content')


    <div class="container-offerta_dettagli">
        <h1> Aggiunta Azienda</h1>
    </div>

    <div class="container-creazione_staff">
        <div class="form-creazione_staff">
            <div class="container-form-creazione_staff">
                <div>
                    {{ Form::open(array('route' => 'aggiunta azienda', 'class' => 'contact-form', 'method' => 'POST')) }}

                    <div  class="container-dati-creazione_staff">
                        {{ Form::label('nome', 'Nome', ['class' => 'label-input']) }}
                        {{ Form::text('nome', '', ['class' => 'input', 'id' => 'nome']) }}
                    </div>
                    @if ($errors->first('nome'))
                        <ul class="errors">
                            @foreach ($errors->get('nome') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif


                    <div  class="container-dati-creazione_staff">
                        {{ Form::label('partita_iva', 'Partita Iva', ['class' => 'label-input']) }}
                        {{ Form::text('partita_iva', '', ['class' => 'input', 'id' => 'cognome' ]) }}

                    </div>
                    @if ($errors->first('partita_iva'))
                        <ul class="errors">
                            @foreach ($errors->get('partita_iva') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div  class="container-dati-creazione_staff">
                        {{ Form::label('descrizione', 'Descrizione', ['class' => 'label-input']) }}
                        {{ Form::text('descrizione', '', ['class' => 'input', 'id' => 'cognome' ]) }}

                    </div>
                    @if ($errors->first('descrizione'))
                        <ul class="errors">
                            @foreach ($errors->get('descrizione') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div  class="container-dati-creazione_staff">
                        {{ Form::label('email', 'Email', ['class' => 'label-input']) }}
                        {{ Form::text('email', '', ['class' => 'input','id' => 'email']) }}

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

                    <div class="container-dati-creazione_staff">
                        {{ Form::label('località', 'Località', ['class' => 'label-input']) }}
                        {{ Form::text('località', '', ['class' => 'input', 'id' => 'eta']) }}

                    </div>
                    @if ($errors->first('località'))
                        <ul class="errors">
                            @foreach ($errors->get('località') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="container-dati-creazione_staff">
                        {{ Form::label('telefono', 'Telefono', ['class' => 'label-input']) }}
                        {{ Form::text('telefono', '', ['class' => 'input', 'id' => 'telefono']) }}
                    </div>
                    @if ($errors->first('telefono'))
                        <ul class="errors">
                            @foreach ($errors->get('telefono') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif


                    <div  class="container-dati-creazione_staff">
                        {{ Form::label('logo', 'Logo', ['class' => 'label-input']) }}
                        {{ Form::text('logo', '', ['class' => 'input', 'id' => 'cognome' ]) }}

                    </div>
                    @if ($errors->first('logo'))
                        <ul class="errors">
                            @foreach ($errors->get('logo') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="container-dati-creazione_staff">
                        {{ Form::label('Tipologia', 'Tipologia', ['class' => 'label-input']) }}
                        {{ Form::text('Tipologia', '', ['class' => 'input', 'id' => 'numero_civico']) }}

                    </div>
                    @if ($errors->first('Tipologia'))
                        <ul class="errors">
                            @foreach ($errors->get('Tipologia') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif


                    <div class="container-dati-creazione_staff">
                        {{ Form::label('ragione_sociale', 'Ragione Sociale', ['class' => 'label-input']) }}
                        {{ Form::text('ragione_sociale', '', ['class' => 'input', 'id' => 'numero_civico']) }}

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

            <div class="container-creazione_staff_button">
                {{ Form::submit('Aggiungi', ['class' => 'submit-button']) }}
            </div>


            {{ Form::close() }}
        </div>

    </div>

@endsection
