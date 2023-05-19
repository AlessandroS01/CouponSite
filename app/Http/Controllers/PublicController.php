<?php

namespace App\Http\Controllers;

use App\Models\CatalogoAziende;
use App\Models\CatalogoOfferte;
use App\Models\Resources\Azienda;
use App\Models\Resources\Faq;
use Illuminate\Support\Facades\Log;


class PublicController extends Controller
{

    protected $catalogoAzienda;
    protected $catalogoOfferte;

    public function _construct(){
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
        return view('catalogo_offerte');
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
        return view('offerta')
                    ->with('offerta', $this->catalogoOfferte->getOffertaByID($offertaId));
    }

    public function showAzienda() {
        return view('azienda');
    }

    public function showSearchOfferta() {
        return view('catalogo_offerte')
            ->with('prodotto', request('prodotto'))
            ->with('azienda', request('azienda'));
    }

}
