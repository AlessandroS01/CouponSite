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
        Log::info($username);

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
        }

    }


}
