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
                    <i class="fas fa-pen edit-icon" onclick="toggleEditMode('username')"></i>
                    <button id="saveButton" onclick="saveField('username')" style="display: none;">Salva</button>
                </span>


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


        <script>
            $(document).ready(function() {
                // Quando viene cliccata l'icona di modifica
                $('.edit-icon').on('click', function() {
                    // Ottieni il campo corrispondente da modificare
                    var field = $(this).parent().prev();
                    toggleEditMode(field);
                });

                // Quando viene cliccato il pulsante di salvataggio
                $('#saveButton').on('click', function() {
                    // Ottieni il campo da salvare
                    var field = $(this).parent().prev();
                    saveField(field);
                });
            });

            function toggleEditMode(field) {
                // Trova l'icona e il pulsante di salvataggio correlati al campo
                var icon = field.parent().find('.edit-icon');
                var saveButton = field.parent().find('#saveButton');

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

            function saveField(field) {
                var value = field.text();
                // Esegui l'azione per salvare il valore modificato
                field.attr('contenteditable', 'false');

                var saveButton = field.parent().find('#saveButton');
                saveButton.hide(); // Nascondi il pulsante di salvataggio

                var icon = field.parent().find('.edit-icon');
                icon.show(); // Mostra l'icona di modifica
            }
        </script>


    @endisset

@endsection
