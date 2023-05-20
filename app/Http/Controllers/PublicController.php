<?php

namespace App\Http\Controllers;

use App\Models\CatalogoAziende;
use App\Models\CatalogoOfferte;
use App\Models\Resources\Faq;
use Illuminate\Support\Facades\Log;


class PublicController extends Controller
{
    // variabili utilizzate per effettuare operazioni sui dati del db.
    protected $catalogoAziende;
    protected $catalogoOfferte;

    public function __construct(){
        $this->catalogoAziende = new CatalogoAziende;
        $this->catalogoOfferte = new CatalogoOfferte;
    }


    /**
     * @return @View vista home a cui passa anche le variabili per ottenere le 3 aziende dello slideshow,
     * le 5 aziende sotto lo slideshow, e le 6 offerte totali della home page pubblica.
     * All'interno della vista vengono richiamati i metodi di $catalogoAzienda e $catalogoOfferte
     * per ricercare i dati su db.
     */
    public function showHome() {
        return view('home')
                    ->with('catalogoAziende', $this->catalogoAziende)
                    ->with('catalogoOfferte', $this->catalogoOfferte);
    }

    /**
     * @return @View che permette di visualizzare il catalogo delle offerte
     */
    public function showCatalogoOfferte() {

        $offerte = $this->catalogoOfferte->getOfferteByName();

        return view('catalogo_offerte')
                            -> with('offerte', $offerte);
    }

    /**
     * @return @View che permette di visualizzare il catalogo delle aziende
     */
    public function showCatalogoAziende() {
        return view('catalogo_aziende');
    }

    /**
     * @return @View che permette di visualizzare i contatti del sito
     */
    public function showContatti() {
        return view('contatti');
    }

    /**
     * @return @View che permette di visualizzare le faq del sito
     */
    public function showFaq() {
        // passa alla vista l'insieme di tutte le faq
        return view('faqs', [ 'faqs' => Faq::all()] );
    }

    public function showLogin() {
        return view('login');
    }

    public function showSignup() {
        return view('signup');
    }

    public function showClientHome() {
        return view('homeClient');
    }

    /**
     * @param $offertaId è il paramatro passato direttamente dalla rotta e rappresenta il codice dell'offerta
     * una volta che l'user clicca su OTTIENI nella card.
     * @return  @View a cui si passa $gestoreOfferte per poter ottenere il logo di un'azienda data l'offerta e
     * calcolare il valore del prezzo scontato, $offerta che rappresenta l'offerta di cui si vogliono visualizzare i
     * dati, e $azienda che serve a visualizzare il logo e un riferimento dell'azienda associata a quell'offerta
     */
    public function showOfferta($offertaId) {

        $offerta = $this->catalogoOfferte->getOffertaByID($offertaId);

        $azienda = $this->catalogoAziende->getAziendaByOfferta($offerta);

        return view('offerta')
                    ->with('gestoreOfferte', $this->catalogoOfferte)
                    ->with('offerta', $offerta )
                    ->with('azienda', $azienda );
    }

    /**
     * @param $partita_iva è il paramatro passato direttamente dalla rotta e rappresenta la partita iva
     * dell'azienda cliccata.
     * @return  @View a cui si passa $azienda che serve a visualizzare le varie informazioni dell'azienda selezionata
     * e $offerte che rappresenta una lista di offerte emesse da quella specifica azienda.
     */
    public function showAzienda($partita_iva) {

        $azienda = $this->catalogoAziende->getAziendaByPartitaIva($partita_iva);

        $offerte = $this->catalogoOfferte->getOfferteByAzienda($azienda->partita_iva);

        return view('azienda')
                        ->with('azienda', $azienda)
                        ->with('offerte', $offerte);
    }



    public function showSearchOfferta(Request $request) {

        $prodotto = $request->input('prodotto');
        $azienda = $request->input('azienda');

        $offerte = $this->catalogoOfferte->getOffertaByProdotto($prodotto);
        return view('catalogo_offerte')
            ->with('offerte', $offerte)
            ->with('azienda', $azienda);
    }

}
