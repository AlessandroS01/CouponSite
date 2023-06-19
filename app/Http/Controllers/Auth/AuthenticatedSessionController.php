<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/*
 * Controller di autenticazione
 */
class AuthenticatedSessionController extends Controller {

    /**
     * Ritorna la vista in cui si effettua il login
     */
    public function create() {
        return view('auth.login');
    }

    /**
     * gestisce il processo di autenticazione dell'utente
     * e il reindirizzamento a rotte specifiche in base al ruolo dell'utente
     */
    public function store(LoginRequest $request) {
        // authenticate gestisce il controllo tra le credenziali passate e quelle presenti nel db
        $request->authenticate();

        // ricrea la sessione con un nuovo id per l'utente che si è autenticato
        $request->session()->regenerate();

        // estraiamo dall'utente autenticato il suo ruolo
        $livello = auth()->user()->livello;

        // In base al livello, l'utente viene reindirizzato in rotte diverse
        switch ($livello) {
            case '1':
            case '2':
            case '3': return redirect()->route('home');
                break;
            default: return redirect('/');
        }
    }

    /**
     * azione che permette di fare il logout di un utente loggato
     */
    public function destroy(Request $request) {
        // effettua il logout dell'user autenticato e pulisce lo stato dell'autenticazione
        Auth::guard('web')->logout();
        // invalida la sessione dell'utente che era prima autenticato
        $request->session()->invalidate();
        // regenera il token per la sessione dell'utente a seguito del logout
        $request->session()->regenerateToken();
        // reindirizza l'utente alla rotta home
        return redirect('/');
    }


}
