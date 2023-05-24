@extends('layouts.public')

@section('title', 'Profilo')

@section('content')

    @isset($user)
        <div class="container-logouser">
            <i class="fa fa-user-cog" style="color: #363945;"></i>
        </div>

        <div class="container-profile">
            <div class="data">

                <h3>Username:</h3>
                <p id="username">{{$user->username}} <i id="username-edit" class="fas fa-pen edit-icon"></i></p>
                {{ Form::open(array('route' => 'profilo', 'class' => 'form-modifica-dati', 'id' => 'modifica-username')) }}
                <div class="input-modifica-profilo">
                    {{ Form::text('username', '', ['class' => 'input','id' => 'username-input']) }}
                    {{ Form::submit('Modifica', ['class' => 'submit-button']) }}
                    {{ Form::close() }}
                </div>


                <h3>Email:</h3>
                <p id="email">{{$user->email}} <i id="email-edit" class="fas fa-pen edit-icon"></i></p>
                {{ Form::open(array('route' => 'profilo', 'class' => 'form-modifica-dati', 'id' => 'modifica-email')) }}
                <div class="input-modifica-profilo">
                    {{ Form::text('email', '', ['class' => 'input','id' => 'email-input']) }}
                    {{ Form::submit('Modifica', ['class' => 'submit-button']) }}
                </div>
                {{ Form::close() }}

                <h3>Telefono:</h3>
                <p id="telefono">{{$user->telefono}} <i id="telefono-edit" class="fas fa-pen edit-icon"></i></p>
                {{ Form::open(array('route' => 'profilo', 'class' => 'form-modifica-dati', 'id' => 'modifica-telefono')) }}
                <div class="input-modifica-profilo">
                    {{ Form::text('telefono', '', ['class' => 'input','id' => 'telefono-input']) }}
                    {{ Form::submit('Modifica', ['class' => 'submit-button']) }}
                </div>
                {{ Form::close() }}

                <h3>Indirizzo:</h3>
                <p id="indirizzo">{{$user->citta}}, {{$user->via}} - {{$user->numero_civico}} <i id="indirizzo-edit" class="fas fa-pen edit-icon"></i></p>
                {{ Form::open(array('route' => 'profilo', 'class' => 'form-modifica-dati', 'id' => 'modifica-indirizzo')) }}
                <div class="input-modifica-profilo">
                    {{ Form::text('citta', '', ['class' => 'input','id' => 'citta-input']) }}
                    {{ Form::text('via', '', ['class' => 'input','id' => 'via-input']) }}
                    {{ Form::text('numero_civico', '', ['class' => 'input','id' => 'numero_civico-input']) }}
                    {{ Form::submit('Modifica', ['class' => 'submit-button']) }}
                </div>
                {{ Form::close() }}

            </div>


            <div class="data">

                <h3>Nome:</h3>
                <p id="nome">{{$user->nome}} <i id="nome-edit" class="fas fa-pen edit-icon"></i></p>
                {{ Form::open(array('route' => 'profilo', 'class' => 'form-modifica-dati', 'id' => 'modifica-nome')) }}
                <div class="input-modifica-profilo">
                    {{ Form::text('nome', '', ['class' => 'input','id' => 'nome-input']) }}
                    {{ Form::submit('Modifica', ['class' => 'submit-button']) }}
                </div>
                {{ Form::close() }}

                <h3>Cognome:</h3>
                <p id="cognome">{{$user->cognome}} <i id="cognome-edit" class="fas fa-pen edit-icon"></i></p>
                {{ Form::open(array('route' => 'profilo', 'class' => 'form-modifica-dati', 'id' => 'modifica-cognome')) }}
                <div class="input-modifica-profilo">
                    {{ Form::text('cognome', '', ['class' => 'input','id' => 'cognome-input']) }}
                    {{ Form::submit('Modifica', ['class' => 'submit-button']) }}
                </div>
                {{ Form::close() }}

                <h3>Genere:</h3>
                <p id="genere">{{$user->genere}} <i id="genere-edit" class="fas fa-pen edit-icon"></i></p>
                {{ Form::open(array('route' => 'profilo', 'class' => 'form-modifica-dati', 'id' => 'modifica-genere')) }}
                <div class="input-modifica-profilo">
                    {{ Form::text('genere', '', ['class' => 'input','id' => 'genere-input']) }}
                    {{ Form::submit('Modifica', ['class' => 'submit-button']) }}
                </div>
                {{ Form::close() }}

                <h3>Età:</h3>
                <p id="eta">{{$user->eta}} <i id="eta-edit" class="fas fa-pen edit-icon"></i></p>
                {{ Form::open(array('route' => 'profilo', 'class' => 'form-modifica-dati', 'id' => 'modifica-eta')) }}
                <div class="input-modifica-profilo">
                    {{ Form::text('eta', '', ['class' => 'input','id' => 'eta-input']) }}
                    {{ Form::submit('Modifica', ['class' => 'submit-button']) }}
                </div>
                {{ Form::close() }}

            </div>
        </div>

    @endisset


    @isset($coupons)

        <div class="container-coupon-riscattati">
            <table>
                <tr>
                    <th>ID offerta</th>
                    <th>Nome offerta</th>
                    <th>Azienda</th>
                    <th>Coupon</th>
                    <th>Data acquisizione</th>
                </tr>

                @foreach($coupons as $coupon)
                    <tr>
                        <td>{{$coupon->id}} </td>
                        <td>{{$coupon->nome_offerta}} </td>
                        <td>{{$coupon->azienda}}</td>
                        <td>{{$coupon->codice}}</td>
                        <td>{{$coupon->data}}</td>
                    </tr>
                @endforeach
            </table>
        </div>

    @endisset


    <script>

        $(document).ready(function() {
            $('.edit-icon').click(function() {
                var $parent = $(this).parent('p'); // Elemento <p> genitore dell'icona di modifica
                $parent.hide(); // Nascondi il primo tag <p> vicino all'icona
                $parent.next('form').show(); // Mostra il form immediatamente successivo al tag <p>

                // In alternativa, puoi usare il seguente codice per mostrare solo il form all'interno dello stesso blocco:
                // $(this).closest('.data').find('form').show();
            });
        });
    </script>
@endsection
