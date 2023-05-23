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
                <p>{{$user->username}}
                    <i class="fas fa-pen"></i>
                </p>


                <h3>Email:</h3>
                <p>{{$user->email}}
                    <i class="fas fa-pen"></i>
                </p>

                <h3>Telefono:</h3>
                <p>{{$user->telefono}}
                    <i class="fas fa-pen"></i>
                </p>

                <h3>Indirizzo:</h3>
                <p>{{$user->citta}}, {{$user->via}} {{$user->numero_civico}}
                    <i class="fas fa-pen"></i>
                </p>

            </div>

            <div class="data">
                <h3>Nome:</h3>
                <p>{{$user->nome}}
                    <i class="fas fa-pen"></i>
                </p>

                <h3>Cognome:</h3>
                <p>{{$user->cognome}}
                    <i class="fas fa-pen"></i>
                </p>

                <h3>Genere:</h3>
                <p> {{$user->genere}}
                    <i class="fas fa-pen"></i>
                </p>

                <h3>Età:</h3>
                <p> {{$user->eta}}
                    <i class="fas fa-pen"></i>
                </p>
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
@endsection
