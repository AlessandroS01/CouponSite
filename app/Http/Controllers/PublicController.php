<?php

namespace App\Http\Controllers;

use App\Models\CatalogoAziende;
use App\Models\Resources\Azienda;
use App\Models\Resources\Faq;
use Illuminate\Support\Facades\Log;


class PublicController extends Controller
{

    //passare alla view i prodotti da visualizzare nella home contenuti in Models/prodotti.php
    public function showHome() {
        $allAziende = Azienda::all();
        $catalogoAziende = new CatalogoAziende;
        return view('home')
                    ->with('allAziende', $allAziende)
                    ->with('catalogoAziende', $catalogoAziende);
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


    public function showOfferta() {
        return view('offerta');
    }

    public function showAzienda() {
        return view('azienda');
    }

}
