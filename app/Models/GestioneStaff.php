<?php

namespace App\Models;

use App\Models\Resources\Acquisizione;
use App\Models\Resources\Azienda;
use App\Models\Resources\Gestione;
use App\Models\Resources\Offerta;
use Brick\Math\BigInteger;
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

    /**
     * @return tutte le offerte che lo staff può gestire
     */
    public function getOfferteByStaff(){
        $staffId = Auth::id();

        $offerte = Gestione::join('azienda', 'gestione.azienda', '=', 'azienda.partita_iva')
            ->join('offerta', 'offerta.azienda', '=', 'azienda.partita_iva')
            ->where('gestione.staff', $staffId)
            ->select('offerta.*')
            ->get();

        return $offerte;
    }

    /**
     * @return i nomi di tutte le offerte che lo staff può gestire
     */
    public function getNomeOfferteByStaff(){
        $staffId = Auth::id();

        $oggettoOfferte = Gestione::join('azienda', 'gestione.azienda', '=', 'azienda.partita_iva')
            ->join('offerta', 'offerta.azienda', '=', 'azienda.partita_iva')
            ->where('gestione.staff', $staffId)
            ->pluck('offerta.oggetto_offerta')
            ->toArray();

        return $oggettoOfferte;
    }










}
