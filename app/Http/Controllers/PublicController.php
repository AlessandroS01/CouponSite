<?php

namespace App\Http\Controllers;

use App\Models\CatalogoAziende;
use App\Models\CatalogoOfferte;
use App\Models\GestioneFaq;
use App\Models\Resources\Faq;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;


class PublicController extends Controller
{
    // variabili utilizzate per effettuare operazioni sui dati del db.
    protected $catalogoAziende;
    protected $catalogoOfferte;

    protected $faqs;

    // All'interno del costruttore vengono settate le variabili secondo i model
    public function __construct(){
        $this->catalogoAziende = new CatalogoAziende;
        $this->catalogoOfferte = new CatalogoOfferte;
        $this->faqs = new GestioneFaq;
    }


    // Funzione legata alla rotta home che permette di visualizzare la vista home
    // alla quale verranno passate le variabili catalogoAziende e catalogoOfferte
    public function showHome() {

        return view('home')
                    ->with('catalogoAziende', $this->catalogoAziende)
                    ->with('catalogoOfferte', $this->catalogoOfferte);
    }

    // Permette di visualizzare il catalogo delle offerte
    public function showCatalogoOfferte() {

        // Ottiene tutte le offerte dal catalogo
        $offerte = $this->catalogoOfferte->getAll();

        // Restituisce la vista 'ricercaCatalogo.catalogo_offerte_visualizza'
        // passandogli le offerte e l'oggetto di gestione delle offerte
        return view('ricercaCatalogo.catalogo_offerte_visualizza')
                            -> with('offerte', $offerte)
                            -> with('gestioneOfferte', $this->catalogoOfferte);
    }

    /**
     * ritorna una vista che fa visualizzare le offerte in relazione alla ricerca
     * fatta all'interno del form della vista catalogo_offerte
     */
    public function searchOfferteRicerca(Request $request) {

        // Ottengo i parametri di input inseriti dall'utente nella form della vista catalogo_offerte
        $offertaInput = $request['offerta'];
        $aziendaInput = $request['azienda'];

        // Caso in cui vengono inseriti entrambi i parametri di ricerca
        if ( !empty($offertaInput) and !empty($aziendaInput) )
            {
                // Ottengo le offerte corrispondenti all'azienda e al nome dell'offerta inserite nel form
                $offerte = $this->catalogoOfferte->getOfferteByAziendeEProdotto($aziendaInput, $offertaInput);

            }
        // Caso in cui viene inserita solo l'azienda come input
        else if ( empty($offertaInput) and !empty($aziendaInput)  )
            {
                // Ottengo le offerte corrispondenti all'azienda specificata
                $offerte = $this->catalogoOfferte->getOfferteByAziendeRicercate($aziendaInput);

            }
        // Caso in cui viene inserito solo il nome dell'offerta come input
        else if ( !empty($offertaInput) and empty($aziendaInput) )
            {
                // Ottengo le offerte corrispondenti al nome dell'offerta specificata
                $offerte = $this->catalogoOfferte->getOffertaByRicerca($offertaInput);
            }

        // Caso in cui non si immettono campi di input
        else $offerte = $this->catalogoOfferte->getAll();

        // Restituisco la vista catalogo_offerte_visualizza con le offerte specifiche
        return view('ricercaCatalogo.catalogo_offerte_visualizza')
                    ->with('offerte', $offerte)
                    ->with('gestioneOfferte', $this->catalogoOfferte);

    }

    /**
     * ritorna la view che permette di visualizzare il catalogo delle aziende
     */
    public function showCatalogoAziende() {

        // vengono selezionate tutte le aziende
        $aziende = $this->catalogoAziende->getAll();


        return view('ricercaCatalogo.catalogo_aziende_visualizza')
                    ->with('aziende', $aziende);
    }


    /**
     * ritorna la vista che permette di visualizzare il catalogo delle aziende a seguito della ricerca
     */
    public function searchAziendeRicerca() {

        // Prende quello che è stato scritto nella ricerca dell'azienda
        $aziendaInput = $_GET['azienda'];

        // Caso in cui si immette in input il nome dell'azienda
        if ( !empty($aziendaInput) )
        {
            // vengono selezionate tutte le aziende che hanno un nome che contiene l'input dato dalla ricerca
            $aziende = $this->catalogoAziende->getAziendeByNome($aziendaInput);

        }
        // Caso in cui non è stato inserito nulla all'interno della ricerca
        else {
            // Vengono selezionate tutte le aziende
            $aziende = $this->catalogoAziende->getAll();
        }

        return view('ricercaCatalogo.catalogo_aziende_visualizza')
                    ->with('aziende', $aziende);

    }

    /**
     * ritorna la view di visualizzazione dei contatti del sito
     */
    public function showContatti() {
        return view('contatti');
    }

    /**
     * ritorna la view di visualizzazione delle faq del sito al quale passo
     * tutte le faqs
     */
    public function showFaq() {
        // passa alla vista l'insieme di tutte le faq
        return view('faqs', [ 'faqs' => $this->faqs->getFaqs()] );
    }


    /**
     * viene passato alla funzione $offertaId è il paramatro passato direttamente dalla rotta e
     * rappresenta il codice dell'offerta una volta che l'user clicca su OTTIENI nella card.
     * ritorna la vista a cui si passa:
     * $gestoreOfferte per poter ottenere il logo di un'azienda data l'offerta e calcolare il valore del prezzo scontato,
     * $offerta che rappresenta l'offerta di cui si vogliono visualizzare i dati,
     * $azienda che serve a visualizzare il logo e un riferimento dell'azienda associata a quell'offerta
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

    //metodo richiamato per il download della documentazione
    public function download()
    {
        $path = public_path('documents/Relazione.pdf');

        return response()->download($path);
    }



}
