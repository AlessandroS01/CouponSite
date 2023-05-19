<?php

namespace App\Models;

use App\Models\Resources\Offerta;
use Illuminate\Database\Eloquent\Model;

class CatalogoOfferte extends Model {

    /**
     * @return i primi 3 elementi della relazione Offerta
     */
    public function getPrimiTreElementi() {
        return Offerta::take(3)->get();
    }

    /**
     * @return i primi 3 elementi della relazione Offerta
     * che hanno scadenza imminente
     */
    public function getElementiDataScadenza() {
        return Offerta::orderBy('data_scadenza')->take(3)->get();
    }



}
