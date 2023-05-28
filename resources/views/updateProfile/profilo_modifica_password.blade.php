@extends('profilo')


@section('profilo-content')



        <div class="container-generale-password">

            @if (session('message'))
                <p class="message-modifica-password-fail">{{ session('message') }}</p>
            @endif

            {{ Form::open(array('route' => 'profilo-modifica-password', 'class' => 'form-modifica-dati','id'=>'modifica-dati-form', 'method' => 'POST')) }}
            @csrf
            <h3>Password attuale:</h3>
            {{ Form::password('oldpassword', ['class' => 'input', 'id' => 'old-password']) }}

            <h3>Nuova password:</h3>
            {{ Form::password('password', ['class' => 'input', 'id' => 'password']) }}

            <h3>Ripeti nuova password</h3>
            {{ Form::password('password_confirmation', ['class' => 'input', 'id' => 'password-confirm']) }}
                @if ($errors->first('password'))
                    <ul class="errors">
                        @foreach ($errors->get('password') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif

            {{ Form::submit('Modifica', ['class' => 'submit-button']) }}
            {{ Form::close() }}
            <a class="back-button" href="{{route('profilo')}}"> Annulla </a>
        </div>

<script>


</script>

@endsection
