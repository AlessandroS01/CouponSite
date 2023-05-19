<?php

namespace App\Http\Controllers;

use App\Models\CatalogoAziende;
use App\Models\CatalogoOfferte;
use App\Models\Resources\Azienda;
use App\Models\Resources\Faq;
use Illuminate\Support\Facades\Log;


class PublicController extends Controller
{

    protected $catalogoAziende;
    protected $catalogoOfferte;

    public function __construct(){
        $this->catalogoAziende = new CatalogoAziende;
        $this->catalogoOfferte = new CatalogoOfferte;
    }


    //passare alla view i prodotti da visualizzare nella home contenuti in Models/prodotti.php
    public function showHome() {
        return view('home')
                    ->with('catalogoAziende', $this->catalogoAziende)
                    ->with('catalogoOfferte', $this->catalogoOfferte);
    }

    public function showCatalogoOfferte() {

        $offerte = $this->catalogoOfferte->getOfferteByName();

        return view('catalogo_offerte')
                            -> with('offerte', $offerte);
    }

    public function showCatalogoAziende() {
        return view('catalogo_aziende');
    }

    public function showContatti() {
        return view('contatti');
    }

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


    public function showOfferta($offertaId) {

        $offerta = $this->catalogoOfferte->getOffertaByID($offertaId);

        return view('offerta')
                    ->with('offerta', $offerta )
                    ->with('azienda', $this->catalogoAziende->getAziendaByOfferta($offerta));
    }

    public function showAzienda($nome) {

        $azienda = $this->catalogoAziende->getAziendaByNome($nome);
        $offerte = $this->catalogoOfferte->getOfferteByAzienda($azienda);

        return view('azienda')
                        ->with('azienda', $azienda)
                        ->with('offerte', $offerte);
    }

    public function showSearchOfferta() {
        $prodotto = request('prodotto');
        $offerte = $this->catalogoOfferte->getOffertaByProdotto($prodotto);
        return view('catalogo_offerte')
            ->with('offerte', $offerte)
            ->with('azienda', request('azienda'));
    }

}
