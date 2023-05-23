<?php

namespace App\Http\Controllers;

use App\Models\CatalogoAziende;
use App\Models\CatalogoOfferte;
use App\Models\Resources\Faq;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;


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

        $offerte = $this->catalogoOfferte->getAll();

        return view('ricercaCatalogo.catalogo_offerte_visualizza')
                            -> with('offerte', $offerte)
                            -> with('gestioneOfferte', $this->catalogoOfferte);
    }

    /**
     * @return @View che permette di visualizzare il catalogo delle offerte a seguito della ricerca
     */
    public function searchOfferteRicerca(Request $request) {

        $offertaInput = $request['offerta'];

        $aziendaInput = $request['azienda'];

        // caso in cui si immettono entrambi i parametri di ricerca
        if ( !empty($offertaInput) and !empty($aziendaInput) )
            {
                // vengono selezionate tutte le aziende che hanno un nome che contiene l'input dato dalla ricerca
                $aziendeSelezionate = $this->catalogoAziende->getAziendeByNome($aziendaInput);
                // vengono prese tutte le offerte delle aziende selezionate nella riga sopra
                $offerte = $this->catalogoOfferte->getOfferteByAziendeEProdotto($aziendeSelezionate, $offertaInput);

            }
        // caso in cui si immette solo l'azienda come campo di ricerca
        else if ( empty($offertaInput) and !empty($aziendaInput)  )
            {

                $aziende = $this->catalogoAziende->getAziendeByNome($aziendaInput);
                $offerte = $this->catalogoOfferte->getOfferteByAziendeRicercate($aziende);

            }
        // caso in cui si immette solo l'offerta come campo di ricerca
        else if ( !empty($offertaInput) and empty($aziendaInput) )
            {
                $offerte = $this->catalogoOfferte->getOffertaByRicerca($offertaInput);
            }
        // caso in cui non si immettono campi di ricerca
        else $offerte = $this->catalogoOfferte->getAll();



        return view('ricercaCatalogo.catalogo_offerte_visualizza')
                    ->with('offerte', $offerte)
                    ->with('gestioneOfferte', $this->catalogoOfferte);

    }

    /**
     * @return @View che permette di visualizzare il catalogo delle aziende
     */
    public function showCatalogoAziende() {

        // vengono selezionate tutte le aziende
        $aziendeSelezionate = $this->catalogoAziende->getAll();
        // le aziende selezionate vengono poi impaginate tramite il metodo paginate della classe CatalogoAziende
        $aziende = $this->catalogoAziende->paginate($aziendeSelezionate, 3, null, ['path' => URL::full(), 'pageName' => 'page']);


        return view('ricercaCatalogo.catalogo_aziende_visualizza')
                    ->with('aziende', $aziende);
    }


    /**
     * @return @View che permette di visualizzare il catalogo delle aziende a seguito della ricerca
     */
    public function searchAziendeRicerca() {

        //prende quello che è stato scritto nella ricerca dell'azienda
        $aziendaInput = $_GET['azienda'];

        // caso in cui si immettono entrambi i parametri di ricerca
        if ( !empty($aziendaInput) )
        {
            // vengono selezionate tutte le aziende che hanno un nome che contiene l'input dato dalla ricerca
            $aziendeSelezionate = $this->catalogoAziende->getAziendeByNome($aziendaInput);

            // le aziende selezionate vengono poi impaginate tramite il metodo paginate della classe CatalogoAziende
            $aziende = $this->catalogoAziende->paginate($aziendeSelezionate, 3, null, ['path' => URL::full(), 'pageName' => 'page']);

        }
        else {
            // vengono selezionate tutte le aziende
            $aziendeSelezionate = $this->catalogoAziende->getAll();
            // le aziende selezionate vengono poi impaginate tramite il metodo paginate della classe CatalogoAziende
            $aziende = $this->catalogoAziende->paginate($aziendeSelezionate, 3, null, ['path' => URL::full(), 'pageName' => 'page']);
        }



        return view('ricercaCatalogo.catalogo_aziende_visualizza')
                    ->with('aziende', $aziende);

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





}
