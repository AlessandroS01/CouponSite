@extends('layouts.admin')

@section('title', 'Area Admin')

@section('content')
<div class="static">
    <h3>Area Amministratore</h3>
    <!-- Auth::user()->name restituisce il nome dell'utente autenticato
    Auth riporta dietro tutti i dati dell'utente all'interno della sessione -->
    <p>Benvenuto {{ Auth::user()->nome }} {{ Auth::user()->cognome }}</p>
    <p>Seleziona la funzione da attivare</p>
</div>
@endsection


