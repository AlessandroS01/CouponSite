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
                <p id="username">{{$user->username}}</p>
                <span>
                    <i class="fas fa-pen edit-icon"></i>
                    <button class="saveButton" style="display: none;">Salva</button>
                </span>

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


        <script>
            $(document).ready(function() {
                // Aggiungi un gestore di eventi a tutte le icone di modifica
                $('.edit-icon').on('click', function() {
                    // Ottieni il campo corrispondente da modificare
                    var field = $(this).parent().prev();
                    toggleEditMode(field, $(this));
                });

                // Aggiungi un gestore di eventi a tutti i pulsanti di salvataggio
                $('.saveButton').on('click', function() {
                    // Ottieni il campo da salvare
                    var field = $(this).parent().prev();
                    saveField(field, $(this));
                });
            });

            function toggleEditMode(field, icon) {
                var saveButton = icon.next('.saveButton');

                if (field.attr('contenteditable') === 'true') {
                    // Se il campo è già modificabile, disabilita la modifica
                    field.attr('contenteditable', 'false');
                    saveButton.hide(); // Nascondi il pulsante di salvataggio
                    icon.show(); // Mostra l'icona di modifica
                } else {
                    // Se il campo non è modificabile, abilita la modifica
                    field.attr('contenteditable', 'true');
                    saveButton.show(); // Mostra il pulsante di salvataggio
                    icon.hide(); // Nascondi l'icona di modifica
                    field.focus(); // Fai focus sul campo per facilitare la modifica
                }
            }

            function saveField(field, saveButton) {
                var value = field.text();
                // Esegui l'azione per salvare il valore modificato
                field.attr('contenteditable', 'false');

                saveButton.hide(); // Nascondi il pulsante di salvataggio
                var icon = saveButton.prev('.edit-icon');
                icon.show(); // Mostra l'icona di modifica
            }
        </script>

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
