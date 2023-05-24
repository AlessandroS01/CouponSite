<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CatalogoAziende;
use App\Models\CatalogoOfferte;
use App\Models\ProfileUser;
use App\Models\Resources\Product;
use App\Http\Requests\NewProductRequest;
use GuzzleHttp\Psr7\Request;
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

        if (!empty($username)) {
            $validator = Validator::make($request->all(), [
                'username' => ['required', 'string', 'min:8', 'max:50', 'unique:users']
            ]);

            if ($validator->fails()) {
                // La validazione ha fallito, gestisci l'errore come desideri
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // Validazione passata, esegui l'aggiornamento dello username nella tabella users
            $user = User::find(auth()->user()->id);
            $user->username = $username;
            $user->save();

            // Reindirizza all'azione successiva o alla pagina di conferma
            return redirect()->route('profilo')
                ->with('message', 'Username aggiornato con successo');
        }

        // Se il campo username è vuoto, puoi gestirlo come desideri
        // Ad esempio, puoi restituire un messaggio di errore o reindirizzare l'utente a un'altra pagina
        return redirect()->back()->withErrors(['username' => 'Il campo username è obbligatorio'])->withInput();
    }


}
