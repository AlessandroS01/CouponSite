<?php

namespace App\Models;

use App\Models\Resources\Acquisizione;
use App\Models\Resources\Azienda;
use App\Models\Resources\Offerta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProfileUser extends Model {

function getCoupons($idUser)
{

    $risultato = Acquisizione::join('offerta', 'acquisizione.offerta', '=', 'offerta.codice')
        ->join('azienda', 'offerta.azienda', '=', 'azienda.partita_iva')
        ->select('acquisizione.offerta as id', 'offerta.oggetto_offerta as nome_offerta', 'azienda.nome as azienda', 'acquisizione.codice_coupon as codice', 'acquisizione.created_at as data')
        ->where('acquisizione.cliente', '=', $idUser)
        ->get();

    return $risultato; //Acquisizione::where("cliente", $idUser)->get();

}
}


