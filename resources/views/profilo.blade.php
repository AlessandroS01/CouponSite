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
                <p id="username">{{$user->username}} <i id="hide" class="fas fa-pen edit-icon"></i></p>
                {{ Form::open(array('route' => 'profilo', 'class' => 'form-username', 'id' => 'modifica-username')) }}
                <div class="input-modifica-profilo">
                    {{ Form::text('username', '', ['class' => 'input','id' => 'username']) }}
                    {{ Form::submit('Modifica', ['class' => 'submit-button']) }}
                </div>

                {{ Form::close() }}



                <h3>Email:</h3>
                <p id="email">{{$user->email}}</p>
                <span>
                    <i class="fas fa-pen edit-icon"></i>
                    <button class="saveButton" style="display: none;">Salva</button>
                </span>

                <h3>Telefono:</h3>
                <p id="telefono">{{$user->telefono}}</p>
                <span>
                    <i class="fas fa-pen edit-icon"></i>
                    <button class="saveButton" style="display: none;">Salva</button>
                </span>

                <h3>Indirizzo:</h3>
                <p id="indirizzo">{{$user->citta}}, {{$user->via}} {{$user->numero_civico}}</p>
                <span>
                    <i class="fas fa-pen edit-icon"></i>
                    <button class="saveButton" style="display: none;">Salva</button>
                </span>

            </div>

            <div class="data">
                <h3>Nome:</h3>
                <p id="nome">{{$user->nome}}</p>
                <span>
                    <i class="fas fa-pen edit-icon"></i>
                    <button class="saveButton" style="display: none;">Salva</button>
                </span>

                <h3>Cognome:</h3>
                <p id="cognome">{{$user->cognome}}</p>
                <span>
                    <i class="fas fa-pen edit-icon"></i>
                    <button class="saveButton" style="display: none;">Salva</button>
                </span>

                <h3>Genere:</h3>
                <p id="genere">{{$user->genere}}</p>
                <span>
                    <i class="fas fa-pen edit-icon"></i>
                    <button class="saveButton" style="display: none;">Salva</button>
                </span>

                <h3>Età:</h3>
                <p id="eta">{{$user->eta}}</p>
                <span>
                    <i class="fas fa-pen edit-icon"></i>
                    <button class="saveButton" style="display: none;">Salva</button>
                </span>
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
    $('#hide').click(function() {
        $('#username').hide();
        $('#modifica-username').show();
    });
    });

    </script>
@endsection
