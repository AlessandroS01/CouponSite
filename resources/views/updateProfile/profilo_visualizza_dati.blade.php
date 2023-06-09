@extends('profilo')


@section('profilo-content')

<!-- Verifichiamo che l'utente sia loggato -->
@isset($user)

    <div class="options-user">
        <!--Definiamo le rotte per la modifica dei dati dello user e per la modifica della password -->
        <a href="{{route('profilo-modifica-dati')}}">Modifica dati generali</a>
        <a href="{{route('profilo-modifica-password')}}"> Modifica password </a>
    </div>

    <div class="container-generale-profile">
        <!-- Determina se esiste una variabile di sessione che ha nome 'message'-->
        @if (session('message'))
            <p class="message-modifica-password-success">{{ session('message') }}</p>
        @endif
            <div class="container-profile">
                <div class="data">

                    <h3>Username:</h3>
                    <p>{{$user->username}}</p>

                    <h3>Email:</h3>
                    <p>{{$user->email}}</p>



                    <h3>Telefono:</h3>
                    <p>{{$user->telefono}}</p>


                    <h3>Indirizzo:</h3>
                    <p>{{$user->citta}}, {{$user->via}} {{$user->numero_civico}}</p>


                </div>


                <div class="data">

                    <h3>Nome:</h3>
                    <p>{{$user->nome}}</p>



                    <h3>Cognome:</h3>
                    <p>{{$user->cognome}}</p>


                    <h3>Genere:</h3>
                    <p>{{$user->genere}}</p>

                    <h3>Età:</h3>
                    <p>{{$user->eta}}</p>
                </div>
            </div>

</div>

@endisset

<!--Verifica che $coupons sia settato-->
@isset($coupons)

    <!--Andiamo a costruire una tabella che mostra i coupon generati dall'utente-->
    <div class="container-coupon-riscattati">
        <table>
            <tr>
                <!-- definite le celle di "heading" -->
                <th>ID offerta</th>
                <th>Nome offerta</th>
                <th>Azienda</th>
                <th>Coupon</th>
                <th>Data acquisizione</th>
            </tr>

            <!--Per ogni coupon andiamo a riempire una riga della tabella che mostra i coupon erogati dall'utente -->
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
