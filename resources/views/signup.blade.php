@extends('layouts.public')

@section('title', 'Signup')

@section('content')

<div class="container-login">
    
    <h1>Registrazione Utente</h1>


    <div class="container-auth">

        <div class="container-dati-login">
            <input type="text" name="nome" required >
            <span> Nome</span>
        </div>

        <div class="container-dati-login">
            <input type="text" name="cognome" required>
            <span> Cognome</span>
        </div>

        <div class="container-dati-login">
            <input type="email" name="email" required>
            <span> Email</span>
        </div>

        <div class="container-dati-login">
            <input type="password" name="password" required>
            <span> Password</span>
        </div>

        <div class="container-dati-login">
            <input type="password" name="conferma-password" required>
            <span> Conferma Password</span>
        </div>

        <div class="container-dati-login">
            <input type="number" name="età" min="10" max="110" require>
            <span> Età</span>
        </div>

    </div>
    

    <div class="container-autenticazione_button">
        <button type="button">
            <span> Registrati </span>
        </button>
    <div>    
</div>

@endsection