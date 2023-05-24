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
    /*Quando un client invia una richiesta HTTP POST al percorso 'register', Laravel si occupa automaticamente di creare un oggetto Request
    che rappresenta la richiesta e lo passa come argomento al metodo*/
    public function store(Request $request)
    {
        // Prima verifica tutte le varie regole di validazione
        $request->validate([
            'username' => ['required', 'string', 'min:8', 'max:50', 'unique:users'],
            'password' => ['required', 'max:50', 'confirmed', Rules\Password::defaults()],
            'nome' => ['required', 'string', 'max:50'],
            'cognome' => ['required', 'string', 'max:50'],
            'genere' => ['required', 'string', 'max:1'],
            'eta' => ['required', 'int', 'min:1', 'max:99'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            'telefono' => ['required', 'numeric', 'digits_between:10,20'],
            'via' => ['required', 'string', 'max:100'],
            'numero_civico' => ['required', 'int'],
            'citta' => ['required', 'string', 'max:50'],
        ]);
        // crea la nuova tupla da aggiungere al database
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nome' => $request->nome,
            'cognome' => $request->cognome,
            'genere'=>$request->genere,
            'eta'=>$request->eta,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'via' => $request->via,
            'numero_civico' => $request->numero_civico,
            'citta' => $request->citta,
        ]);

        // definisce l'evento della creazione di un nuovo utente registrato
        event(new Registered($user));
        // viene fatto il login del nuovo utente
        Auth::login($user);
        // reindirizza alla rotta definita su HOME -> bisogna ridefinire in maniera giusta la rotta
        return redirect(RouteServiceProvider::HOME);
    }
}
