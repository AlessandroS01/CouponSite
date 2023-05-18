@extends('layouts.public')

@section('title', 'Login')

@section('content')

<div class="container-login">

    <h1> Login </h1>

    <div class="container-auth">
        <div class="container-dati-login">
            <input type="text" name="login-username" required>
            <span> Username</span>
        </div>
    
        <div class="container-dati-login">
            <input type="password" name="login-password" required>
            <span> Password</span>
        </div>
        </div>
    <div class="container-autenticazione_button">
        <button type="button" >
            <a href="{{ route('homeClient') }}"> Login </a>
        </button>
    <div>


</div>
@endsection