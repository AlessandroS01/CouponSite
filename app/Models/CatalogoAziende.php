<?php

namespace App\Models;

use App\Models\Resources\Azienda;
use App\Models\Resources\Offerta;
use Illuminate\Database\Eloquent\Model;

class CatalogoAziende extends Model {

    /**
     * @return i primi 3 elementi della relazione Azienda
     */
    public function getPrimiTreElementi() {
        return Azienda::take(3)->get();
    }

    /**
     * @return i primi 5 elementi della relazione Azienda
     */
    public function getPrimiCinqueElementi() {
        return Azienda::take(5)->get();
    }

    /**
     * @return l'azienda di una determinata offerta
     */
    public function getAziendaByOfferta(Offerta $offerta) {
        return Azienda::where('partita_iva', $offerta->azienda)->get();
    }



}
