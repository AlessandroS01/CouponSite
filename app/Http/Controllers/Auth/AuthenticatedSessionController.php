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

        $request->session()->regenerate();

        /**
         * Redirezione su diverse Home Page in base alla classe d'utenza.
         */
//        return redirect()->intended(RouteServiceProvider::HOME);

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
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }


}
