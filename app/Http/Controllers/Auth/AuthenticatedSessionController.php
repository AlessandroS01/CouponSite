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
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create() {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request) {
        // authenticate gestisce il controllo tra le credenziali passate e quelle presenti nel db
        $request->authenticate();
        // ricrea la sessione con un nuovo id per l'utente che si è autenticato
        $request->session()->regenerate();


        // estraiamo dall'utente autenticato il suo ruolo
        $livello = auth()->user()->livello;
        /*
         * In base al ruolo, l'utente viene reindirizzato in rotte diverse
         */
        switch ($livello) {
            case '2':
            case '1':
            case '3': return redirect()->route('home');
                break;
            default: return redirect('/');
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request) {
        // effettua il logout dell'user autenticato e pulisce lo stato dell'autenticazione
        Auth::guard('web')->logout();
        // invalida la sessione dell'utente che era rpima autenticato
        $request->session()->invalidate();
        // regenera il token per la sessione dell'utente a seguito del logout
        $request->session()->regenerateToken();
        // reindirizza l'utente alla rotta definita tramite '/', cioè la home
        return redirect('/');
    }


}
