<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

/*
 * Controller per la registrazione
 */
class RegisteredUserController extends Controller
{
    /**
     * Ritorna la vista di registrazione
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * valida i dati dell'utente inseriti in fase di registrazione e crea l'utente all'interno del database
     * a cui viene passato l'oggetto request che rappresenta il request object nel quale sono inseriti tutti i
     * dati immessi nel form di registrazione
     */

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
        // reindirizza alla rotta predefinita
        return redirect('/');
    }


}
