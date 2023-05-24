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

function modificaProfilo(Request $request){
    $request->validate([
        'username' => ['required', 'string', 'min:8', 'max:50', 'unique:users'],
        'password' => ['required', 'max:50', 'confirmed', Rules\Password::defaults()],
        'nome' => ['required', 'string', 'max:50'],
        'cognome' => ['required', 'string', 'max:50'],
        'genere' => ['required', 'string', 'max:1'],
        'eta' => ['required', 'int'],
        'email' => ['required', 'string', 'email', 'max:50', 'unique:users'],
        'telefono' => ['required', 'numeric', 'digits_between:10,20'],
        'via' => ['required', 'string', 'max:100'],
        'numero_civico' => ['required', 'int'],
        'citta' => ['required', 'string', 'max:50'],
    ]);
}



}
