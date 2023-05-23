<?php

namespace App\Models;

use App\Models\Resources\Azienda;
use App\Models\Resources\Offerta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class CatalogoAziende extends Model {

    /**
     * @return tutti gli elementi della relazione Azienda
     */
    public function getAll() {

        $aziende = Azienda::orderBy('nome', 'asc')->get();

        $aziende = $this->paginate($aziende, 3, null, ['path' => URL::full(), 'pageName' => 'page']);

        return $aziende;

    }


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
     * @param $partita_iva rappresenta la partita iva dell'azienda che si vuole ricercare
     * @return l'azienda con la partita iva data come parametro
     */
    public function getAziendaByPartitaIva($partita_iva) {

        return Azienda::where('partita_iva', $partita_iva)->first();

    }

    /**
     * @param $nome rappresenta il nome dell'azienda che si vuole ricercare
     * @return l'azienda con il nome data come parametro se esiste
     */
    public function getAziendeByNome($nome) {

        $aziende = Azienda::where('nome', 'like', '%'.$nome.'%')->get();

        $aziende = $this->paginate($aziende, 3, null, ['path' => URL::full(), 'pageName' => 'page']);

        return $aziende;

    }

    /**
     * @param $offerta rappresenta l'offerta da cui si può riprendere la partita iva dell'azienda
     * @return l'azienda di una determinata offerta
     */
    public function getAziendaByOfferta($offerta) {
        return Azienda::where('partita_iva', $offerta->azienda)->first();
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
