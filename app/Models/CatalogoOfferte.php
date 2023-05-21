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
     * @return tutte le offerte
     */
    public function getAll() {

        $offerte = Offerta::orderBy('percentuale_sconto', 'desc')->get();

        $offerte = $this->paginate($offerte, 3, null, ['path' => URL::full(), 'pageName' => 'page']);

        return $offerte;

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

        // crea una nuova collezione di dati
        $offerte = collect();

        foreach ($aziende as $azienda) {
            // alla collezione di oggetti vengono aggiunte tutte le offerte cha hanno come azienda quella
            // ripresa dalla variabile $azienda.
            // Viene eseguito quindi il merge di una nuovo array all'interno della collezione
            $offerte = $offerte->merge(Offerta::where('azienda', $azienda->partita_iva)
                ->get()
                ->toArray());
        }

        // serve a prendere il contenuto della collezione e trasformarlo in una collezione di oggetti.
        // L'encode codifica la collezione in json mentre il decode lo decodifica per creare la collezione
        // di oggetti da passare alla vista tramite il controller.
        $offerte = json_decode(json_encode($offerte));

        // Estrae la lista delle percentuali sconto all'interno dell'array ritrovato
        $sconti = array_column($offerte, 'percentuale_sconto');

        // Ordina l'array $offerte secondo il valore della colonna $sconti per valori discendenti
        array_multisort($sconti, SORT_DESC, $offerte);

        // richiama il metodo per impaginare la lista di oggetti.
        // La variabile path, settato al valore dell'URL corrente tramite il metodo full della Facade URL, serve a
        // rappresentare l'url per la generazione della paginazione per mantenere intatti i parametri passati tramite il
        // metodo GET. La variabile pageName invece rappresenta il valore corrente della pagina visualizzata tramite
        // paginazione che prende il valore di $page all'interno del metodo per la creazione della paginazione stessa.
        $offerte = $this->paginate($offerte, 3, null, ['path' => URL::full(), 'pageName' => 'page']);

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
     * Viene utilizzato per calcolare il valore della prezzo scontato nella pagina di visualizzazione di una singola offerta
     * @param $offerta rappresenta l'offerta di cui si vuole calcolare il prezzo scontato
     * @return il prezzo scontato del prodotto
     */
    public function getPrezzoScontato($offerta){

        return $offerta->prezzo_pieno - ( $offerta->prezzo_pieno * ( $offerta->percentuale_sconto / 100) ) ;

    }

    public function getOffertaByRicerca($offertaRicercata) {

        $offerte = Offerta::where('oggetto_offerta', 'like', '%'.$offertaRicercata.'%')->orderBy('percentuale_sconto', 'desc')->get();

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
     * @return LengthAwarePaginator ovvero una nuova lista di elementi di $items ma paginata
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






}
