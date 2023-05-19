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

    /**
     * @param $offertaId rappresenta il codice dell'offerta che si passa dalla rotta
     * @return ritorna l'offerta che ha come codice quello passato da parametro
     */
    public function getOffertaByID($offertaId){
        return Offerta::where('codice',$offertaId)->first();
    }

    /**
     * @param $azienda rappresenta l'azienda di cui si vogliono ritrovare le offerte
     * @return la lista delle offerte dell'azienda passata come parametro
     */
    public function getOfferteByAzienda($partita_iva){
        return Offerta::where('azienda', $partita_iva)->get();
    }

    public function getOffertaByProdotto($prodotto) {
        return Offerta::where('oggetto_offerta', 'like', "%{$prodotto}%")->get();
    }
    public function getPrezzoScontato($offerta){

    }

    public function getOfferteByName() {
        return Offerta::orderBy('azienda')->get();
    }






}
