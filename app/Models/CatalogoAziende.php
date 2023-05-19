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
     * @return l'azienda con la partita iva data come parametro
     */
    public function getAziendaByPartitaIva($partita_iva) {
        return Azienda::where('partita_iva', $partita_iva)->first();
    }

    /**
     * @param $offerta rappresenta l'offerta da cui si può riprendere la partita iva dell'azienda
     * @return l'azienda di una determinata offerta
     */
    public function getAziendaByOfferta(Offerta $offerta) {
        return Azienda::where('partita_iva', $offerta->azienda)->first();
    }



}
