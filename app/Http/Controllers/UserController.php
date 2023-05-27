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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

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
     return view('updateProfile.profilo_visualizza_dati')
        ->with('user', $user)
        ->with('coupons', $coupons);

}

function ShowModificaDati(){

    $user= Auth::user();
    return view('updateProfile.profilo_modifica_dati')
        ->with('user', $user);

}

function ShowModificaPassword(){

    $user= Auth::user();
    return view('updateProfile.profilo_modifica_password')
        ->with('user', $user);

}


    public function updateData(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'nome' => ['required', 'string', 'max:50'],
            'cognome' => ['required', 'string', 'max:50'],
            'genere' => ['required', 'string', 'max:1'],
            'eta' => ['required', 'int', 'min:1', 'max:99'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:users,email,'.$user->id],
            'telefono' => ['required', 'numeric', 'digits_between:10,20'],
            'via' => ['required', 'string', 'max:100'],
            'numero_civico' => ['required', 'int'],
            'citta' => ['required', 'string', 'max:50'],
        ]);

        $user->nome = $request->nome;
        $user->cognome = $request->cognome;
        $user->genere = $request->genere;
        $user->eta = $request->eta;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->via = $request->via;
        $user->numero_civico = $request->numero_civico;
        $user->citta = $request->citta;

        $user->save();

        return redirect()->route('profilo')
            ->with('message', "Dati modificati con successo");

    }

    public function updatePassword(Request $request)
    {
        $user = User::find(Auth::id());
        Log::info("entro qua ".Hash::make($request->oldpassword));
        Log::info("password ".$user->password);
        if(Hash::check($request->oldpassword, $user->password)){
            Log::info("confronto andato a buon fine");
            $request->validate([
                'password' => ['required', 'max:50', 'confirmed', Rules\Password::defaults()]
            ]);

            $user->password = Hash::make($request->password);

            $user->save();

            return redirect()->route('profilo')
                ->with('message', "Password modificata con successo");
        }else{

            $request->validate([
                'password' => ['required', 'max:50', 'confirmed', Rules\Password::defaults()]
            ]);

            return redirect()->route('profilo-modifica-password')
                ->with('message', "vecchia password incorretta");
        }


    }







}
