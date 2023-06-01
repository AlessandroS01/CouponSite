@extends('profilo')


@section('profilo-content')



        <div class="container-generale-profile">


            {{ Form::open(array('route' => 'profilo-modifica-dati', 'class' => 'form-modifica-dati','id'=>'modifica-dati-form', 'method' => 'POST')) }}
            @csrf
            <div class="container-profile">
                <div class="data">

                    <h3>Username:</h3>
                    <div class="input-modifica-profilo">
                        {{ Form::text('username', $user->username, ['class' => 'input','id' => 'username-input', 'placeholder' => 'Modifica Username']) }}
                    </div>
                    @if ($errors->first('username'))
                        <ul class="errors">
                            @foreach ($errors->get('username') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif


                    <h3>Email:</h3>

                    <div class="input-modifica-profilo">
                        {{ Form::text('email', $user->email, ['class' => 'input','id' => 'email-input', 'placeholder' => 'Modifica Email']) }}
                    </div>
                    @if ($errors->first('email'))
                        <ul class="errors">
                            @foreach ($errors->get('email') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <h3>Telefono:</h3>

                    <div class="input-modifica-profilo">
                        {{ Form::text('telefono', $user->telefono, ['class' => 'input','id' => 'telefono-input', 'placeholder' => 'Modifica Telefono']) }}
                    </div>
                    @if ($errors->first('telefono'))
                        <ul class="errors">
                            @foreach ($errors->get('telefono') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <h3>Indirizzo:</h3>

                    <div class="input-modifica-profilo">
                        {{ Form::text('citta', $user->citta, ['class' => 'input ','id' => 'citta-input', 'placeholder'=>'Modifica citta']) }}
                        {{ Form::text('numero_civico', $user->numero_civico, ['class' => 'input ','id' => 'numero_civico-input', 'placeholder'=>'Modifica numero civico']) }}
                        {{ Form::text('via', $user->via, ['class' => 'input','id' => 'via-input', 'placeholder'=>'Modifica via']) }}

                    </div>
                </div>


                <div class="data">

                    <h3>Nome:</h3>

                    <div class="input-modifica-profilo">
                        {{ Form::text('nome', $user->nome, ['class' => 'input','id' => 'nome-input','placeholder' => 'Modifica Nome']) }}
                    </div>
                    @if ($errors->first('nome'))
                        <ul class="errors">
                            @foreach ($errors->get('nome') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <h3>Cognome:</h3>

                    <div class="input-modifica-profilo">
                        {{ Form::text('cognome', $user->cognome, ['class' => 'input','id' => 'cognome-input','placeholder' => 'Modifica Cognome']) }}
                    </div>
                    @if ($errors->first('cognome'))
                        <ul class="errors">
                            @foreach ($errors->get('cognome') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <h3>Genere:</h3>


                    <div class="input-modifica-profilo">
                        {{ Form::select('genere', ['M' => 'M', 'F' => 'F'], $user->genere, ['class' => 'select', 'id' => 'genere-input']) }}
                    </div>
                    @if ($errors->first('genere'))
                        <ul class="errors">
                            <li>{{ $errors->first('genere') }}</li>
                        </ul>
                    @endif


                    <h3>Età:</h3>

                    <div class="input-modifica-profilo">
                        {{ Form::text('eta', $user->eta, ['class' => 'input','id' => 'eta-input', 'placeholder' => 'Modifica Età']) }}
                    </div>
                    @if ($errors->first('eta'))
                        <ul class="errors">
                            @foreach ($errors->get('eta') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif


                </div>
            </div>

            {{ Form::submit('Modifica', ['class' => 'submit-button', 'id'=>'submit-modifica']) }}
            {{ Form::close() }}
            <a class="back-button" href="{{route('profilo')}}"> Annulla </a>
        </div>



@endsection

@section('scriptprofilo')

    @can('isUser')
        <script src="{{ asset('js/ModificaDatiUser.js') }}"></script>
    @endcan

    @can('isStaff')
        <script src="{{ asset('js/ModificaDatiStaff.js') }}"></script>
    @endcan

@endsection
