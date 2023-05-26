<?php

namespace App\Models;

use App\Models\Resources\Acquisizione;
use App\Models\Resources\Azienda;
use App\Models\Resources\Gestione;
use App\Models\Resources\Offerta;
use Brick\Math\BigInteger;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GestioneAdmin extends Model {


    public function getUsernames(){

        return User::query()->pluck('username')->toArray();
    }

    public function createStaff(Request $request){

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
            'livello' => '2',
        ]);

        // definisce l'evento della creazione di un nuovo utente registrato
        event(new Registered($user));
    }


}
