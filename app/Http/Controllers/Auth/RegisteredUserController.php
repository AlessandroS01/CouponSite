<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

/*
 * Controller per la registrazione
 */
class RegisteredUserController extends Controller
{
    /**
     * Creazione della vista per la registrazione
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * request è un Request object che viene creato a seguito del click
     * del bottone Registrati della form di registrazione
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        /*
         * Aggiunta di tutti i parametri definiti all'interno del model di Utenti
         */

        // Prima verifica tutte le varie regole di validazione
        $request->validate([
            // TODO da modificare tutti questi parametri
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            // unique:users -> definisce l'unicità di tutti i vari record di users di email e username
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['required', 'string', 'min:8', 'unique:users'],

            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        // viene generata una nuova tupla dell'utente
        event(new Registered($user));
        // viene fatto il login del nuovo utente
        Auth::login($user);
        // reindirizza alla rotta definita su HOME -> bisogna ridefinire in maniera giusta la rotta
        return redirect(RouteServiceProvider::HOME);
    }
}
