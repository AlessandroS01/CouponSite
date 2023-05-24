<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CatalogoAziende;
use App\Models\CatalogoOfferte;
use App\Models\ProfileUser;
use App\Models\Resources\Product;
use App\Http\Requests\NewProductRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller {


protected $ProfileUser;
protected $CatalogoOfferte;
protected $CatalogoAziende;

public function __construct()
{
    $this->ProfileUser = new ProfileUser();
    $this->CatalogoOfferte=new CatalogoOfferte();
    $this->CatalogoAziende= new CatalogoAziende();
}


function showProfilo(){

     $user= Auth::user();
     $coupons = $this->ProfileUser->getCoupons($user->id);
     Log::info($coupons);
     return view('profilo')
        ->with('user', $user)
        ->with('coupons', $coupons);

}


    public function updateData(Request $request)
    {
        $username = $request->input('username');
        $nome = $request->input('nome');
        $cognome = $request->input('cognome');
        $email = $request->input('email');
        $telefono = $request->input('telefono');
        $eta = $request->input('eta');
        $genere = $request->input('genere');
        $citta = $request->input('citta');
        $via = $request->input('via');
        $ncivico = $request->input('numero_civico');



        if (!empty($username)) {
            $request->validate([
                'username' => ['required', 'string', 'min:8', 'max:50', 'unique:users'],
            ]);


            // Validazione passata, esegui l'aggiornamento dello username nella tabella users
            $user = User::find(auth()->user()->id);
            $user->username = $username;
            $user->save();

            // Reindirizza all'azione successiva o alla pagina di conferma
            return redirect()->route('profilo')
                ->with('message', 'Username aggiornato con successo');
        } else if (!empty($nome)){
            $request->validate([
                'nome' => ['required', 'string', 'max:50'],
            ]);


            // Validazione passata, esegui l'aggiornamento dello username nella tabella users
            $user = User::find(auth()->user()->id);
            $user->nome = $nome;
            $user->save();

            // Reindirizza all'azione successiva o alla pagina di conferma
            return redirect()->route('profilo')
                ->with('message', 'Nome aggiornato con successo');

        } else if (!empty($cognome)){
            $request->validate([
                'cognome' => ['required', 'string', 'max:50'],
            ]);


            // Validazione passata, esegui l'aggiornamento dello username nella tabella users
            $user = User::find(auth()->user()->id);
            $user->cognome = $cognome;
            $user->save();

            // Reindirizza all'azione successiva o alla pagina di conferma
            return redirect()->route('profilo')
                ->with('message', 'Cognome aggiornato con successo');

        }else if (!empty($email)){
            $request->validate([
                'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
            ]);


            // Validazione passata, esegui l'aggiornamento dello username nella tabella users
            $user = User::find(auth()->user()->id);
            $user->email = $email;
            $user->save();

            // Reindirizza all'azione successiva o alla pagina di conferma
            return redirect()->route('profilo')
                ->with('message', 'Email aggiornato con successo');

        }else if (!empty($telefono)){
            $request->validate([
                'telefono' => ['required', 'numeric', 'digits_between:10,20'],
            ]);


            // Validazione passata, esegui l'aggiornamento dello username nella tabella users
            $user = User::find(auth()->user()->id);
            $user->telefono = $telefono;
            $user->save();

            // Reindirizza all'azione successiva o alla pagina di conferma
            return redirect()->route('profilo')
                ->with('message', 'Telefono aggiornato con successo');

        }else if (!empty($eta)){
            $request->validate([
                'eta' => ['required', 'int', 'min:1', 'max:99'],
            ]);


            // Validazione passata, esegui l'aggiornamento dello username nella tabella users
            $user = User::find(auth()->user()->id);
            $user->eta = $eta;
            $user->save();

            // Reindirizza all'azione successiva o alla pagina di conferma
            return redirect()->route('profilo')
                ->with('message', 'Eta aggiornata con successo');

        }else if (!empty($genere)){
            $request->validate([
                'genere' => ['required', 'string', 'max:1'],
            ]);


            // Validazione passata, esegui l'aggiornamento dello username nella tabella users
            $user = User::find(auth()->user()->id);
            $user->genere = $genere;
            $user->save();

            // Reindirizza all'azione successiva o alla pagina di conferma
            return redirect()->route('profilo')
                ->with('message', 'Genere aggiornato con successo');

        }else if (!empty($citta) && !empty($via) && !empty($ncivico)){
            $request->validate([
                'via' => ['required', 'string', 'max:100'],
                'numero_civico' => ['required', 'int'],
                'citta' => ['required', 'string', 'max:50'],
            ]);


            // Validazione passata, esegui l'aggiornamento dello username nella tabella users
            $user = User::find(auth()->user()->id);
            $user->citta = $citta;
            $user->via = $via;
            $user->numero_civico = $ncivico;
            $user->save();

            // Reindirizza all'azione successiva o alla pagina di conferma
            return redirect()->route('profilo')
                ->with('message', 'Indirizzo aggiornato con successo');

        }

        return redirect()->route('profilo');
    }


}
