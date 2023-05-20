<?php

namespace App\Models;

use App\Models\Resources\Azienda;
use App\Models\Resources\Offerta;
use Illuminate\Database\Eloquent\Model;

class CatalogoOfferte extends Model {

    /**
     * @return tutte le offerte
     */
    public function getAll() {
        return Offerta::all();
    }

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
     * @param $partita_iva rappresenta la partita iva dell'azienda di cui si vogliono ritrovare le offerte
     * @return la lista delle offerte dell'azienda che ha la partita iva passata come parametro
     */
    public function getOfferteByAzienda($partita_iva){

        $offerte = Offerta::where('azienda', $partita_iva)
            ->orderBy('percentuale_sconto', 'desc')
            ->get();

        return $offerte;
    }

    /**
     * @param $aziende rappresenta un array di aziende di cui si vogliono ritrovare le offerte
     * @return la lista delle offerte delle aziende inserite come parametro nella ricerca
     */
    public function getOfferteByAziendeRicercate($aziende){

        $offerte = Offerta::where('azienda', $aziende->partita_iva)
            ->orderBy('percentuale_sconto', 'desc')
            ->get();

        return $offerte;
    }

    /**
     * @param $offerta rappresenta l'offerta da cui si vuole ricercare il logo dell'azienda
     * @return il logo dell'azienda
     */
    public function getLogoAziendaByOfferta($offerta){

        $azienda = Azienda::where('partita_iva', $offerta->azienda)->first();

        return $azienda->logo;

    }

    /**
     * @param $offerta rappresenta l'offerta di cui si vuole calcolare il prezzo
     * @return il prezzo scontato del prodotto
     */
    public function getPrezzoScontato($offerta){

        return $offerta->prezzo_pieno - ( $offerta->prezzo_pieno * ( $offerta->percentuale_sconto / 100) ) ;

    }

    public function getOffertaByRicerca($offertaRicercata) {
        return Offerta::where('oggetto_offerta', 'like', '%'.$offertaRicercata.'%')->get();
    }

    public function getOfferteOrdinateByAzienda() {
        return Offerta::orderBy('azienda')->get();
    }






}
