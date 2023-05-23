<?php

namespace App\Models;

use App\Models\Resources\Acquisizione;
use App\Models\Resources\Gestione;
use Brick\Math\BigInteger;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GestioneStaff extends Model {

    /**
     * @return il nome delle aziende che un membro dello staff può gestire
     */
    public function getNomeAziendeByStaff(){
        $staffId = Auth::id();

        $nomeAziende = Gestione::join('azienda', 'gestione.azienda', '=', 'azienda.partita_iva')
            ->where('gestione.staff', $staffId)
            ->pluck('azienda.nome')
            ->toArray();

        return $nomeAziende;
    }



}
