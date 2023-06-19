<?php

namespace App\Models;

use App\Models\Resources\Azienda;
use App\Models\Resources\Offerta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Symfony\Component\Console\Input\Input;

class CatalogoOfferte extends Model {

    /**
     * ritorna tutte le offerte
     */
    public function getAll() {

        $offerte = Offerta::orderBy('percentuale_sconto', 'desc')->get()
                ->where('flagAttivo', '=', '1');

        $offerte = $this->paginate($offerte, 3, null, ['path' => URL::full(), 'pageName' => 'page']);

        return $offerte;

    }

    /**
     * ritorna le prime 3 offerte attive, ovvero con flagattivo impostato ad 1
     */
    public function getPrimiTreElementi() {
        $offerte = Offerta::where('flagAttivo', '=', '1')
            ->take(3)
            ->get();
        return $offerte;
    }

    /**
     * ritorna le prime 3 offerte attive, ovvero con flagattivo impostato ad 1
     * ordinate in base alla data di scadenza
     */
    public function getElementiDataScadenza() {
        return Offerta::orderBy('data_scadenza')
            ->where('flagAttivo', '=', '1')
            ->take(3)
            ->get();

    }

    /**
     * viene ritornata l'offerta ricercata tramite la sua partita iva
     */
    public function getOffertaByID($offertaId){
        return Offerta::where('codice',$offertaId)
            ->where('flagAttivo', '=', '1')
            ->first();
    }

    /**
     * @param $partita_iva rappresenta la partita iva dell'azienda di cui si vogliono ritrovare le offerte
     * @return la lista delle offerte dell'azienda che ha la partita iva passata come parametro
     */
    public function getOfferteByAzienda($partita_iva){

        $offerte = Offerta::where('azienda', $partita_iva)
            ->where('flagAttivo', '=', '1')
            ->orderBy('percentuale_sconto', 'desc')
            ->get();

        return $offerte;
    }

    /**
     * restituisce le offerte ricercate per nome dell'azienda a cui passo il parametro
     * di input espresso nel form all'interno della vista catalogo_offerte
     */
    public function getOfferteByAziendeRicercate($aziendaInput){

        // Crea una nuova collezione di dati
        $offerte = Offerta::join('azienda', 'offerta.azienda', '=', 'azienda.partita_iva')
            // Tramite $aziendaInput vado a cotrollare il match tra il dato di input e il nome delle aziende
            ->where('azienda.nome', 'like', '%'.$aziendaInput.'%')
            ->where('flagAttivo', '=', '1')
            ->select('offerta.*')
            ->orderBy('offerta.percentuale_sconto', 'desc')
            ->get();


        // Richiama il metodo paginate per impaginare la lista di oggetti.
        // La variabile "path" viene settata al valore dell'URL corrente tramite il metodo "full()" della Facade URL, serve a
        // rappresentare l'URL per la generazione della paginazione per mantenere intatti i parametri passati tramite il
        // metodo GET. La variabile pageName rappresenta il valore corrente della pagina visualizzata tramite
        // paginazione che prende il valore di $page all'interno del metodo per la creazione della paginazione stessa.
        $offerte = $this->paginate($offerte, 3, null, ['path' => URL::full(), 'pageName' => 'page']);

        return $offerte;
    }

    /**
     * restituisce le offerte ricercate per nome dell'azienda e nome dell'offerta
     * a cui passo i parametri di input espressi nel form all'interno della vista catalogo_offerte
     */
    public function getOfferteByAziendeEProdotto($aziendaInput, $offertaInput){

        // crea una nuova collezione di dati
        $offerte = Offerta::join('azienda', 'offerta.azienda', '=', 'azienda.partita_iva')
                    ->where('azienda.nome', 'like', '%'.$aziendaInput.'%')
                    ->where('offerta.oggetto_offerta', 'like', '%'.$offertaInput.'%')
                    ->where('flagAttivo', '=', '1')
                    ->select('offerta.*')
                    ->orderBy('offerta.percentuale_sconto', 'desc')
                    ->get();


        // richiama il metodo per impaginare la lista di oggetti.
        // La variabile path, settato al valore dell'URL corrente tramite il metodo full della Facade URL, serve a
        // rappresentare l'url per la generazione della paginazione per mantenere intatti i parametri passati tramite il
        // metodo GET. La variabile pageName invece rappresenta il valore corrente della pagina visualizzata tramite
        // paginazione che prende il valore di $page all'interno del metodo per la creazione della paginazione stessa.
        $offerte = $this->paginate($offerte, 3, null, ['path' => URL::full(), 'pageName' => 'page']);

        return $offerte;


    }

    /**
     * restituisce le offerte ricercate per nome dell'offerta
     * a cui passo il parametro di input espresso nel form all'interno della vista catalogo_offerte
     */
    public function getOffertaByRicerca($offertaInput) {

        $offerte = Offerta::join('azienda', 'offerta.azienda', '=', 'azienda.partita_iva')
            ->where('offerta.oggetto_offerta', 'like', '%'.$offertaInput.'%')
            ->where('flagAttivo', '=', '1')
            ->select('offerta.*')
            ->orderBy('offerta.percentuale_sconto', 'desc')
            ->get();


        // richiama il metodo per impaginare la lista di oggetti.
        // La variabile path, settato al valore dell'URL corrente tramite il metodo full della Facade URL, serve a
        // rappresentare l'url per la generazione della paginazione per mantenere intatti i parametri passati tramite il
        // metodo GET. La variabile pageName invece rappresenta il valore corrente della pagina visualizzata tramite
        // paginazione che prende il valore di $page all'interno del metodo per la creazione della paginazione stessa.
        $offerte = $this->paginate($offerte, 3, null, ['path' => URL::full(), 'pageName' => 'page']);

        return $offerte;
    }

    /**
     * Metodo usato per creare una paginazione
     * @param $items rappresenta l'array o la lista degli elementi passati
     * @param $perPage rappresenta il numero di elementi di $items che si vogliono visualizzare per pagina. Assume come
     *      valore predefinito null se non viene passato direttamente al richiamo del metodo
     * @param $page rappresenta il numero della pagina corrente
     * @param $options rappresenta una lista di altre opzioni da dare al nuovo elemento di paginazione
     * restituisce LengthAwarePaginator ovvero una nuova lista di elementi di $items (oggetti passati come parametri) paginata
     */
    public function paginate($items, $perPage = 3, $page = null, $options = [])
    {
        // il valore della pagina, se non viene passato come input al richiamo del metodo, viene richiamato un metodo della
        // Facade Paginator per risolvere il problema della pagina corrente. Se non si riesce a stabilire il valore viene settato ad 1
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        // $items viene convertito in una collezione se al passaggio della funzione $items non è di per sè una collezione
        $items = $items instanceof Collection ? $items : Collection::make($items);

        // crea un nuovo oggetto di LengthAwarePaginator passandogli la collezione $items divisa per pagine, dove ad ogni pagina
        // si trovano 3 elementi della collezione, poi il totale degli elementi della collezione, il numero di elementi per
        // ogni pagina, il valore della pagina corrente e tutte le opzioni aggiuntive passate al richiamo del metodo.
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    /**
     * restituisce il logo dell'offerta passata come parametro tramite
     * l'oggetto azienda (logoazienda = logoofferta)
     */
    public function getLogoAziendaByOfferta($offerta){

        $azienda = Azienda::where('partita_iva', $offerta->azienda)->first();

        return $azienda->logo;

    }

    /**
     * restituisce il l'offerta al quale prezzo viene applicata la percentuale di sconto
     */
    public function getPrezzoScontato($offerta){

        return $offerta->prezzo_pieno - ( $offerta->prezzo_pieno * ( $offerta->percentuale_sconto / 100) ) ;

    }

}
