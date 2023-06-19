@extends('layouts.public')

@section('title', 'Statistiche')

@section('link')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('css/statistiche.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/profile.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/catalogo.css') }}" >

@endsection



@section('content')

    @isset($listaCoupon)
    @endisset
    <div class="container-titolo_form">
    <h1> Statistiche </h1>
    </div>

    <div class="container-stats">
        <div class="container-statistiche_totali">

            <div class="container-coupon_totali">
                @isset($couponTotali)
                    <!--Andiamo a far visualizzare il numero totale di coupon emessi -->
                    <h3> Numero coupon emessi: {{ $couponTotali }}</h3>
                @endisset
            </div>

            <div class="container-lista_coupon">
                @isset($listaCouponPaginated)
                    <div class="container-coupon-riscattati">
                        <!--Andiamo a creare una tabella nella quale andremo a mettere le informazioni specifiche
                         dell'utente che ha aquisito un coupon e le informazioni specifiche dell'offerta relativa
                         al coupon erogato-->
                        <table>
                            <tr>
                                <th>ID offerta</th>
                                <th>Nome offerta</th>
                                <th>ID cliente</th>
                                <th>Nome cliente</th>
                                <th>Cognome cliente</th>
                                <th>Coupon</th>
                                <th>Data acquisizione</th>
                            </tr>

                            @foreach($listaCouponPaginated as $coupon)
                                <!--Se il cliente è stato cancellato  -->
                                @if($coupon->id_cliente === null)
                                    <tr>
                                        <td class="container-offerta-Id">{{$coupon->id_offerta}}</td>
                                        <td>{{$coupon->nome_offerta}} </td>
                                        <td>Utente cancellato </td>
                                        <td>Utente cancellato</td>
                                        <td>Utente cancellato</td>
                                        <td>{{$coupon->codice}}</td>
                                        <td>{{$coupon->data}}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td class="container-offerta-Id">{{$coupon->id_offerta}}</td>
                                        <td>{{$coupon->nome_offerta}} </td>
                                        <td class="container-cliente-Id">{{$coupon->id_cliente}} </td>
                                        <td>{{$coupon->nome_cliente}}</td>
                                        <td>{{$coupon->cognome_cliente}}</td>
                                        <td>{{$coupon->codice}}</td>
                                        <td>{{$coupon->data}}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </table>
                    </div>
                    <div class="paginator">
                        {{ $listaCouponPaginated->links() }}
                    </div>
                @endisset
            </div>

            <div class="container-show_hide_stats">
                <div>
                    <h3 id="codice-offerta_id-utente"></h3>
                    <h3 id="numero_coupon"></h3>
                </div>
            </div>




        </div>
    </div>


@endsection

@section('script')
    <script>
        var listaCoupon = {!! $listaCoupon !!};
    </script>

    <script src="{{ asset('js/VisualizzaStatistiche.js') }}"></script>
@endsection


