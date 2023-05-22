<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Resources\Product;
use App\Http\Requests\NewProductRequest;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {


function showProfilo(){

     $user= Auth::user();

     return view('profilo')
        ->with('user', $user);

}

}
