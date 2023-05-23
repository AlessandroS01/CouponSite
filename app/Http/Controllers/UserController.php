<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\CatalogoAziende;
use App\Models\CatalogoOfferte;
use App\Models\ProfileUser;
use App\Models\Resources\Product;
use App\Http\Requests\NewProductRequest;
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

}
