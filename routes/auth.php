<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
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
     * Genera una richeista per l'invio dei dati immessi nella form di registrazione
     */
    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');
});
