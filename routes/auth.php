<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;


/**
 * Viste che sono aggiunte direttamente da breeze che vengono importate
 * all'interno del file web.php
 */
Route::middleware('guest')->group(function () {
    /*
     * Genera una richiesta per la visualizzazione della form di registrazione
     */
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    /*
     * Genera una richiesta per l'invio dei dati immessi nella form di registrazione
     */
    Route::post('register', [RegisteredUserController::class, 'store']);

    /*
     * Genera una richiesta per la visualizzazione della form di login
     */
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    /*
     * Genera una richiesta per l'invio dei dati immessi nella form di login
     */
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

});

Route::middleware('auth')->group(function () {
    /*
    * Rotta implementata nel bottone di logout per andare a disconnettere un
     * utente tramite la funzione destroy
    */
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
