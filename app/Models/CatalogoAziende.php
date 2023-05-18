<?php

namespace App\Models;

use App\Models\Resources\Azienda;
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



}
